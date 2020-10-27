<?php

declare(strict_types = 1);

class User_access_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function user_listing_access(int $user_id, string $package_type, string $user_type): bool {
        $access = FALSE;
        $listing_count = $this->Property_model->get_user_property_count($user_id);
        switch ($user_type) {
            case NORMAL_USER:
                //normal user
                if ($package_type == NORMAL_PACKAGE) {
                    //user - normal package
                    if ($listing_count < 3) {
                        $access = TRUE;
                    }
                } else if ($package_type == SILVER_PACKAGE) {
                    //user - silver package
                    if ($listing_count < 6) {
                        $access = TRUE;
                    }
                } else if ($package_type == GOLD_PACKAGE) {
                    //user - gold package
                    if ($listing_count < 12) {
                        $access = TRUE;
                    }
                } else if ($package_type == PLATINUM_PACKAGE) {
                    //user - platinum package                    
                    $access = TRUE;
                }
                break;
            case AGENT_USER:
                //agent user
                if ($package_type == NORMAL_PACKAGE) {
                    //user - normal package
                    if ($listing_count < 12) {
                        $access = TRUE;
                    }
                } else if ($package_type == SILVER_PACKAGE) {
                    //user - silver package
                    if ($listing_count < 12) {
                        $access = TRUE;
                    }
                } else if ($package_type == GOLD_PACKAGE) {
                    //user - gold package                   
                    $access = TRUE;
                } else if ($package_type == PLATINUM_PACKAGE) {
                    //user - platinum package                   
                    $access = TRUE;
                }
                break;
            case COMPANY_USER:
                //company user
                if ($package_type == SILVER_PACKAGE) {
                    //user - silver package
                    if ($listing_count < 12) {
                        $access = TRUE;
                    }
                } else if ($package_type == GOLD_PACKAGE) {
                    //user - gold package                   
                    $access = TRUE;
                } else if ($package_type == PLATINUM_PACKAGE) {
                    //user - platinum package                   
                    $access = TRUE;
                }
                break;
        }

        return $access;
    }

    public function agent_create_access(int $user_id, string $package_type): bool {
        $access = FALSE;
        $number_of_agents = $this->User_model->get_users_by_main_user_count($user_id);
        switch ($package_type) {
            case SILVER_PACKAGE:
                //silver package max 5 agents
                if ($number_of_agents < 5) {
                    $access = TRUE;
                }
                break;
            case GOLD_PACKAGE:
                //gold package max 10 agents
                if ($number_of_agents < 10) {
                    $access = TRUE;
                }
                break;
            case PLATINUM_PACKAGE:
                //platinum package unlimited agents
                $access = TRUE;
                break;

            default:
                break;
        }

        return $access;
    }

}
