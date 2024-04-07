<?php

namespace Api\V1\Application\Controller;

class AccountsController extends \Api\V1\Application\Controller\AuthenticatorController
{

    function getAccountDetails() {

        $users = $this->getModel("User");
        $users->column['account_id'] = $this->account['account_id'];

        $users
            ->select(" user_id, name, email, user_status as status, created_at ")
                ->and(" user_level != 1 ");

        $data = $users->getByAccountId();

        if($data) {

            unset($this->account['account_id']);
            for($i=0; $i<count($data); $i++) {
                unset($data[$i]['account_id']);
                unset($data[$i]['user_id']);
            }

            $this->account['users'] = $data;
        }

        return json_encode($this->account, JSON_PRETTY_PRINT);

    }


}