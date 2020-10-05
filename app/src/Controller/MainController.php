<?php

namespace App\Controller;

use App\Api\RequestMaker;
use App\Entity\OrderElements;
use App\Entity\Orders;
use App\Form\OrderFormType;
use App\Form\SearchFormType;
use App\Repository\OrdersRepository;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(Request $request, EntityManagerInterface $entityManager, OrdersRepository $ordersRepository)
    {
        $searchForm = $this->createForm(SearchFormType::class);
        $orderForm = $this->createForm(OrderFormType::class);

        $orderForm-> handleRequest($request);
        if ($orderForm->isSubmitted() && $orderForm->isValid()) {
            $data = $orderForm->getData();
            try {
                $api =  new RequestMaker();
                $response = $api->sendRequest('POST', 'https://yandexфывввв.ru', $data);

                $order = json_decode($response->getBody(), true);

                $newOrder = new Orders();
                $newOrder->setCurrency($order['currency'])
                    ->setOrderId($order['orderId'])
                    ->setPaymentStatus($order['payment_status'])
                    ->setPhone($order['phone'])
                    ->setShippingPaymentStatus($order['shipping_payment_status'])
                    ->setShippingPrice($order['shipping_price'])
                    ->setShippingStatus($order['shipping_status']);

                foreach($order['orderItems'] as $orderItem) {
                    $item = new OrderElements();
                    $item->setOrderId($order['orderId'])
                        ->setBarcode($orderItem['barcode'])
                        ->setCanceled($orderItem['canceled'])
                        ->setCost($orderItem['cost'])
                        ->setPrice($orderItem['price'])
                        ->setQuantity($orderItem['quantity'])
                        ->setShippedStatusSku($orderItem['shipped_status_sku'])
                        ->setTaxAmt($orderItem['tax_amt'])
                        ->setTaxPerc($orderItem['tax_perc'])
                        ->setTrackingNumber($orderItem['tracking_number']);

                    $entityManager->persist($item);
                }

                try {
                    $entityManager->flush();
                } catch (UniqueConstraintViolationException $e) {
                    return $this->render('main/index.html.twig', [
                        'order' => $order,
                        'order_form' => $orderForm->createView(),
                        'search_form' => $searchForm->createView(),
                    ]);
                }
                return $this->render('main/index.html.twig', [
                    'order' => $order,
                    'order_form' => $orderForm->createView(),
                    'search_form' => $searchForm->createView(),
                ]);
            } catch (ClientException | ConnectException | RequestException $e) {
                $dbOrder = $ordersRepository->findOneBy(array(
                    'orderId' => $data['order_id']
                ));
                if($dbOrder === null){
                    $message = 'Не подключается к api и такого id нет в локальной базе';

                    return $this->render('main/index.html.twig', [
                        'message' => $message,
                        'order_form' => $orderForm->createView(),
                        'search_form' => $searchForm->createView(),
                    ]);
                }
                return $this->render('main/index.html.twig', [
                    'dbOrder' => $dbOrder,
                    'order_form' => $orderForm->createView(),
                    'search_form' => $searchForm->createView(),
                ]);
            }
        }

        // результаты поиска заказов я не сохраняю в базу, т.к. в ответе нет даты создания заказа, по которой я бы смог достать их, если апи не работает.
        // в ТЗ написан формат даты int (format yyyyMMdd).. но как он может быть int, если MM - подразумевает месяц письменно (например December). Я сделал string в этом формате даты, но могу на что угодно поменять)

        $searchForm-> handleRequest($request);
        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $data = $searchForm->getData();
            try {
                $api =  new RequestMaker();
                $response = $api->sendRequest('POST', 'https://search/api', $data);

                // предполагаю, что при отстутвии результатов вернет null
                if($response->getBody() === null) {
                    return $this->render('main/index.html.twig', [
                        'message' => 'Нет результатов поиска',
                        'order_form' => $orderForm->createView(),
                        'search_form' => $searchForm->createView(),
                    ]);
                }

                $orders = json_decode($response->getBody(), true);

                return $this->render('main/index.html.twig', [
                    'orders' => $orders,
                    'order_form' => $orderForm->createView(),
                    'search_form' => $searchForm->createView(),
                ]);
            } catch (\Exception $e) {
                $message = $e->getMessage();

                return $this->render('main/index.html.twig', [
                    'message' => $message,
                    'order_form' => $orderForm->createView(),
                    'search_form' => $searchForm->createView(),
                ]);
            }


        }

        return $this->render('main/index.html.twig', [
            'order_form' => $orderForm->createView(),
            'search_form' => $searchForm->createView(),
        ]);
    }
}
