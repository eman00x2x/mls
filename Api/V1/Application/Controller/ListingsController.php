<?php

namespace Api\V1\Application\Controller; 

class ListingsController extends \Api\V1\Application\Controller\AuthenticatorController
{

    function getPostedProperties() {

        $listings = $this->getModel("Listing");
        $listings->column['account_id'] = $this->account['account_id'];
        
        $listings
            ->select(" listing_id as id, thumb_img, title, category, offer, price, is_mls, is_website, is_mls_option,
                CASE 
                    WHEN status = 0 THEN 'Expired'
                    WHEN status = 1 THEN 'Active'
                    WHEN status = 2 THEN 'Sold'
                    WHEN status = 3 THEN 'Removed'
                END as status, 
                modified_at,
                created_at ");

        $listings->page['limit'] = 100;
        $listings->page['current'] = isset($_GET['page']) ? $_GET['page'] : 1;

        $data = $listings->getByAccountId();

        if($data) {

            for($i=0; $i<count($data); $i++) {
                unset($data[$i]['account_id']);
            }

            return json_encode([
                "rows" => (int) $listings->rows,
                "page" => [
                    "current" => $listings->page['current'],
                    "total" => $listings->total_pages
                ],
                "data" => $data
            ], JSON_PRETTY_PRINT);
        }

        return json_encode([
            "message" => "no results found"
        ], JSON_PRETTY_PRINT);

    }

    function getProperty($id) {

        $listings = $this->getModel("Listing");
        $listings->column['listing_id'] = $id;
        $listings
            ->select(" listing_id as id, thumb_img, title, foreclosed, category, offer, floor_area, lot_area, bedroom, bathroom, parking, address,
                price, reservation, payment_details, video, tags, amenities, 
                CASE 
                    WHEN status = 0 THEN 'Expired'
                    WHEN status = 1 THEN 'Active'
                    WHEN status = 2 THEN 'Sold'
                    WHEN status = 3 THEN 'Removed'
                END as status, long_desc, 
                JSON_EXTRACT(other_details, '$.authority_type') as authority_type, CONCAT(JSON_UNQUOTE(JSON_EXTRACT(other_details, '$.com_share')), '%') as com_share,
                post_score, modified_at, created_at
            ")
                ->and(" account_id  = ". $this->account['account_id']);

        $data = $listings->getById();
        
        if($data) {

            $data['car_spaces'] = isset($data['parking']) ? $data['parking'] : [];
            
            $images = $this->getModel("ListingImage");
            $images->column['listing_id'] = $id;
            $images->select(" url ");
            $data['images'] = $images->getByListingId();

            if($data['images']) {
                for($i=0; $i<count($data['images']); $i++) {
                    unset($data['images'][$i]['listing_id']);
                }
            }

            $data['payment_details']['bank_loan'] = ($data['payment_details']['bank_loan'] == 1 ? true : false);
            $data['payment_details']['pagibig_loan'] = ($data['payment_details']['pagibig_loan'] == 1 ? true : false);
            $data['payment_details']['assume_balance'] = ($data['payment_details']['assume_balance'] == 1 ? true : false);
            $data['amenities'] = ($data['amenities'] != "" ? explode(",", $data['amenities']) : false);

            unset($data['parking']);
            unset($data['post_score']);
            unset($data['listing_id']);
            unset($data['account_id']);

            return json_encode($data, JSON_PRETTY_PRINT);

        }

        ErrorsController::getInstance()->resourceNotFound();

    }


}