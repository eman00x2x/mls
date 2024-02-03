<?php

define("DEFINITION", [
    /** USER PERMISSIONS */
    "account" => [
        "access" => "Allow this user to update the account details."
    ],
    "users" => [
        "access" => "Allow this user to create new user and update other users details in your account except administrator account.",
        "delete" => "Allow this user to permanently delete other user in your account except administrator account."
    ],
    "leads" => [
        "access" => "Allow this user to access the list of leads in your account.",
        "delete" => "Allow this user to permanently delete a lead in your account."
    ],
    "properties" => [
        "access" => "Allow this user to access the list of real estate properties posted in your account.",
        "delete" => "Allow this user to permanently delete a real estate property posted in your account."
    ],
    "subscriptions" => [
        "purchased" => "Allow this user to purchase a subscription for your account.",
    ],

    /** ACCOUNT ACCESS */
    "leads_DB" => "Allow this account to access the offered leads.",
    "properties_DB" => "Allow this account to access an advance view of the list of real estate properties posted on the main website.",
    
    /** PRIVILIGES */
    "max_post" => "The total number of postings this account can add.",
    "max_users" => "Total number of users this account can add.",
    "display_ads" => "Total number of display ad this account can create.",
    "featured_ads" => "Total number of featured ad this account can create.",
    "handshake_limit" => "Maximum number of handshake can initiate."
]);