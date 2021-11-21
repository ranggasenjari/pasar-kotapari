<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Community Auth - Database Tables Config
 *
 * Community Auth is an open source authentication application for CodeIgniter 3
 *
 * @package     Community Auth
 * @author      Robert B Gottier
 * @copyright   Copyright (c) 2011 - 2017, Robert B Gottier. (http://brianswebdesign.com/)
 * @license     BSD - http://www.opensource.org/licenses/BSD-3-Clause
 * @link        http://community-auth.com
 */

// USER RELATED TABLES
$config['user_table']                   = 'usr_users';

// LOGIN ERROR RELATED TABLES
$config['errors_table']                 = 'usr_login_errors';
$config['IP_hold_table']                = 'usr_ips_on_hold';
$config['username_or_email_hold_table'] = 'usr_username_or_email_on_hold';
$config['denied_access_table']          = 'usr_denied_access';

// SESSION TABLES
$config['sessions_table']               = 'usr_ci_sessions';
$config['auth_sessions_table']          = 'usr_auth_sessions';

// ACL
$config['acl_categories_table']         = 'usr_acl_categories';
$config['acl_actions_table']            = 'usr_acl_actions';
$config['acl_table']                    = 'usr_acl';

// USER RELATED TABLES
$config['dt_usaha']                   = 'dt_usaha';

/* End of file db_tables.php */
/* Location: /community_auth/config/db_tables.php */