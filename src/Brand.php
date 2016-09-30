<?php
    class Brand
    {
        private $id;
        private $brand_name;

        function __construct($brand_name, $id = null)
        {
            $this->brand_name = $brand_name;
            $this->id = $id;
        }
//getters & setters
        function getId()
        {
            return $this->id;
        }

        function getBrandName()
        {
            return $this->brand_name;
        }

        //methods
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO brands (brand_name) VALUES ('{$this->getBrandName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function addStore($store)
        {
            $GLOBALS['DB']->exec("INSERT INTO stores_brands (brand_id, store_id) VALUES ({$this->getId()}, {$store->getId()});");
        }

        function getStores()
        {
          $returned_stores = $GLOBALS['DB']->query("SELECT stores.* FROM brands
            JOIN stores_brands ON (stores_brands.brand_id = brands.id)
            JOIN stores ON (stores.id = stores_brands.store_id)
            WHERE brands.id = {$this->getId()};");


            $stores = array();


            foreach($returned_stores as $store) {
                $name = $store['store_name'];
                $id = $store['id'];
                $new_store = new Store($name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }


        static function find($search_id)
        {
            $found_brand = null;
            $brands = Brand::getAll();
            foreach($brands as $brand) {
                $id = $brand->getId();
                if ($id == $search_id) {
                    $found_brand = $brand;
                }
            }
           return $found_brand;
        }


//static methods
        static function getAll()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
            $brands = array();
            foreach($returned_brands as $brand) {
                $brand_name = $brand['brand_name'];
                $id = $brand['id'];
                $new_brand = new Brand($brand_name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }

        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM brands;");
        }
    }
?>
