<?php

namespace Api\V1\Application\Controller; 

class ListingsController extends \Api\V1\Application\Controller\AuthenticatorController
{

    function getPostedProperties() {

        $listings = $this->getModel("Listing");
        $listings->column['account_id'] = $this->account['account_id'];
        
        $listings
            ->select(" listing_id as id, thumb_img, title, category, offer, price, 
                CASE 
                    WHEN status = 0 THEN 'Expired'
                    WHEN status = 1 THEN 'Active'
                    WHEN status = 2 THEN 'Sold'
                    WHEN status = 3 THEN 'Removed'
                END as status, 
            last_modified as modified_at ");

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
                post_score, last_modified as modified_at, date_added as created_at
            ")
                ->and(" account_id  = ". $this->account['account_id']);

        $data = $listings->getById();

        if($data) {
            
            $images = $this->getModel("ListingImage");
            $images->column['listing_id'] = $data['listing_id'];
            $images->select(" url ");
            $data['images'] = $images->getByListingId();

            if($data['images']) {
                for($i=0; $i<count($data['images']); $i++) {
                    unset($data['images'][$i]['listing_id']);
                }
            }

            unset($data['listing_id']);
            unset($data['account_id']);

            return json_encode($data, JSON_PRETTY_PRINT);

        }

        ErrorsController::getInstance()->resourceNotFound();

    }


}