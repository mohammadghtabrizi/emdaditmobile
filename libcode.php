<?php        
        //for add to orders relation
        $addcart->pc_price = $find->price;

        $addcart->pc_warranty_name = $find->warranty_name;

        $addcart->pc_warranty_date = $find->warranty_date;

        if($find->discount_status === 1){

            $addcart->pc_discount_status = $find->discount_status;

            $addcart->pc_discount_price = $find->discount_price;

            $addcart->pc_discount_percent = $find->discount_percent;
        }
        else if($find->amazing_status === 1){

            $addcart->pc_discount_status = $find->amazing_status;

            $addcart->pc_discount_price = $find->amazing_price;

            $addcart->pc_discount_percent = $find->amazing_percent;
        }


        ?>