<?php

<<<<<<<< HEAD:src/Repository/OrderRepository/OrderRepositoryImpl.php
namespace Up\Repository\OrderRepository;

use Exception;
use Up\Entity\Order;

use Up\Repository\ProductRepository\ProductRepositoryImpl;
use Up\Repository\UserRepository\UserRepositoryImpl;


class OrderRepositoryImpl implements OrderRepository
========
namespace Up\Repository\Order;

use Up\Models;
use Up\Repository\Product\ProductRepositoryImpl;
use Up\Repository\User\UserRepositoryImpl;

class OrderRepositoryRepositoryImpl implements OrderRepository
>>>>>>>> f3757b0 (added interfaces to the repository):src/Repository/Order/OrderRepositoryRepositoryImpl.php
{

	public static function getAll(): array
	{
		$connection = \Up\Util\Database\Connector::getInstance(
			\Up\Util\Configuration::getInstance()->option('DB_HOST'),
			\Up\Util\Configuration::getInstance()->option('DB_USER'),
			\Up\Util\Configuration::getInstance()->option('DB_PASSWORD'),
			\Up\Util\Configuration::getInstance()->option('DB_NAME')
		)->getDbConnection();

		$sql = "select up_order.id, item_id, user_id, delivery_address, created_at ,title as status
				from up_order inner join up_order_item uoi on up_order.id = uoi.order_id
				inner join up_status us on up_order.status_id = us.id";

		$result = mysqli_query($connection, $sql);

		if (!$result)
		{
			throw new \Exception(mysqli_error($connection));
		}

		$orders = [];
		!$isFirstLine = true;
		while ($row = mysqli_fetch_assoc($result))
		{
			if (!isset($products[$row['id']]))
			{
				if (!$isFirstLine)
				{
					$orders[$id] = new Order(
						$id, $products, $user, $deliveryAddress, $createdAt, $status,
					);
				}
				$id = $row['id'];
<<<<<<<< HEAD:src/Repository/OrderRepository/OrderRepositoryImpl.php

========
>>>>>>>> f3757b0 (added interfaces to the repository):src/Repository/Order/OrderRepositoryRepositoryImpl.php
				$products = [ProductRepositoryImpl::getById($row['item_id'])];
				$user = UserRepositoryImpl::getById($row['user_id']);
				$deliveryAddress = $row['delivery_address'];
				$createdAt = $row['created_at'];
				$status = $row['status'];

				$isFirstLine = false;
			}
			else
			{
				$products[] = ProductRepositoryImpl::getById($row['item_id']);
			}
		}

		$orders[$id] = new Order(
			$id, $products, $user, $deliveryAddress, $createdAt, $status,
		);

		return $orders;

	}

	public static function getById(int $id): Order
	{
		$connection = \Up\Util\Database\Connector::getInstance(
			\Up\Util\Configuration::getInstance()->option('DB_HOST'),
			\Up\Util\Configuration::getInstance()->option('DB_USER'),
			\Up\Util\Configuration::getInstance()->option('DB_PASSWORD'),
			\Up\Util\Configuration::getInstance()->option('DB_NAME')
		)->getDbConnection();

		$sql = "select up_order.id, item_id, user_id, delivery_address, created_at ,title as status
				from up_order inner join up_order_item uoi on up_order.id = uoi.order_id
				inner join up_status us on up_order.status_id = us.id
				where up_order.id = {$id}";

		$result = mysqli_query($connection, $sql);

		if (!$result)
		{
			throw new Exception(mysqli_error($connection));
		}

		$isFirstLine = true;
		while ($row = mysqli_fetch_assoc($result))
		{
			if ($isFirstLine)
			{
				$id = $row['id'];
				$products = [ProductRepositoryImpl::getById($row['item_id'])];
				$user = UserRepositoryImpl::getById($row['user_id']);
				$deliveryAddress = $row['delivery_address'];
				$createdAt = $row['created_at'];
				$status = $row['status'];

				$isFirstLine = false;
			}
			else
			{
				$products[] = ProductRepositoryImpl::getById($row['item_id']);
			}
		}
		$order = new Order(
			$id, $products, $user, $deliveryAddress, $createdAt, $status,
		);

		return $order;

	}
}