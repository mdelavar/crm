<?php

namespace App\Traits;


use App\Models\Box;
use App\Models\ProductSerialNumber;

trait SerialHandler
{
    public function getBoxSerial($representation_id): string
    {
        $barcode = "120513";
        $representation_id = sprintf("%04d", $representation_id);
        $random = rand(pow(10, 10), pow(10, 11)-1);

        $final = $barcode . $representation_id . $random;

        if (Box::query()->where('barcode' , $final)->count() > 0) {
            return $this->getBoxSerial($representation_id);
        } else {
            return $final;
        }

    }

    public function getCustomerSerial($ma_date , $product_id): string
    {
        $barcode = "120511";
        $product_id = sprintf("%04d", $product_id);
        $random = rand(pow(10, 3), pow(10, 4)-1);

        $final = $barcode . $ma_date . $product_id . $random;
        if (ProductSerialNumber::query()->where('customer_serial' , $final)->count() > 0) {
            return $this->getCustomerSerial($ma_date ,$product_id);
        } else {
            return $final ;
        }

    }

    public function getRepresentationSerial($ma_date , $product_id): string
    {
        $barcode = "120512";
        $product_id = sprintf("%04d", $product_id);
        $random = rand(pow(10, 3), pow(10, 4)-1);

        $final = $barcode . $ma_date . $product_id . $random;
        if (ProductSerialNumber::query()->where('representation_serial' , $final)->count() > 0) {
            return $this->getRepresentationSerial($ma_date ,$product_id);
        } else {
            return $final;
        }
    }

}
