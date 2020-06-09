<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	http://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There area two reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the 'welcome' class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router what URI segments to use if those provided
  | in the URL cannot be matched to a valid route.
  |
 */

// Auth routes
$route['default_controller'] = 'front/index';
//$route['default_controller'] = 'auth/index';
$route['login/(:any)'] = 'auth/login/$1';
$route['callback/(:any)'] = 'auth/callback/$1';
$route['auth'] = 'auth/signin';
$route['reset'] = 'auth/passwordreset';
$route['signup'] = 'auth/signup';
$route['register'] = 'auth/register';
$route['resend-confirmation'] = 'auth/resend_confirmation';
$route['activate'] = 'auth/activate';
$route['password-reset'] = 'auth/password_reset';
$route['new-password'] = 'auth/new_password';
$route['terms-and-conditions'] = 'auth/terms';
$route['privacy-policy'] = 'auth/privacy';
$route['report-bug'] = 'auth/report_bug';
$route['logout'] = 'auth/logout';

// User routes
$route['user/home'] = 'userarea/dashboard';
$route['user/posts'] = 'userarea/posts';
$route['user/emails'] = 'marketing/emails';
$route['user/emails/(:any)'] = 'marketing/emails/$1';
$route['user/emails/(:any)/(:num)'] = 'marketing/emails/$1/$2';
$route['user/show-campaigns/(:num)/(:any)'] = 'marketing/show_campaigns/$1/$2';
$route['user/show-lists/(:num)/(:any)'] = 'marketing/show_lists/$1/$2';
$route['user/show-lists-meta/(:num)/(:num)'] = 'marketing/show_lists_meta/$1/$2';
$route['user/show-lists-meta/(:num)/(:num)/(:num)'] = 'marketing/show_lists_meta/$1/$2/$3';
$route['unsubscribe/(:num)/(:any)/(:any)'] = 'marketing/unsubscribe/$1/$2/$3';
$route['user/schedules/(:any)/(:num)/(:num)'] = 'marketing/schedules/$1/$2/$3';
$route['user/schedules/(:any)/(:num)/(:num)/(:num)'] = 'marketing/schedules/$1/$2/$3/$4';
$route['seen/(:num)/(:num)'] = 'marketing/mail/$1/$2';
$route['send-mail'] = 'marketing/send_mail';
$route['user/history'] = 'userarea/history';
$route['user/rss-feeds'] = 'userarea/RSS_feeds';
$route['user/rss-feeds/(:any)'] = 'userarea/RSS_feeds/$1';
$route['user/tool/(:any)'] = 'userarea/tool/$1';
$route['user/tools'] = 'userarea/tools';
$route['user/tools/(:any)'] = 'userarea/tools/$1';
$route['user/bots'] = 'bots/bots';
$route['user/bots/(:any)'] = 'bots/bots/$1';
$route['user/bot/(:any)'] = 'bots/bot/$1';
$route['bot-cron'] = 'bots/bot_cron';
$route['user/networks'] = 'userarea/networks';
$route['user/networks/(:any)'] = 'userarea/networks/$1';
$route['user/settings'] = 'userarea/settings';
$route['user/expiration-tokens'] = 'userarea/expiration_tokens';
$route['user/plans'] = 'userarea/plans';
$route['user/success-payment'] = 'userarea/success_payment';
$route['user/upgrade/(:num)'] = 'userarea/upgrade/$1';
$route['user/pay/(:any)/(:num)'] = 'userarea/pay/$1/$2';
$route['user/charge-stripe/(:num)'] = 'userarea/charge_stripe/$1';
$route['user/notifications'] = 'userarea/notifications';
$route['user/option/(:any)'] = 'userarea/set_option/$1';
$route['user/new-rss/(:any)'] = 'userarea/new_rss/$1';
$route['user/new-rss/(:any)/(:num)'] = 'userarea/new_rss/$1/$2';
$route['user/rss-networks/(:any)/(:any)'] = 'userarea/rss_networks/$1/$2';
$route['user/set-schedule-rss/(:any)/(:num)/(:num)/(:num)'] = 'userarea/set_schedule_rss/$1/$2/$3/$4';
$route['user/rss-option/(:num)/(:any)'] = 'userarea/rss_option/$1/$2';
$route['user/get-notification/(:num)'] = 'userarea/get_notification/$1';
$route['user/del-notification/(:num)'] = 'userarea/del_notification/$1';
$route['user/delete-account'] = 'userarea/delete_user_account';
$route['user/delete-feeds/(:num)'] = 'userarea/delete_feeds/$1';
$route['user/update-userinfo'] = 'userarea/update_userinfo';
$route['user/content-from-url/(:any)'] = 'userarea/content_from_url/$1';
$route['user/save-token/(:any)/(:any)'] = 'userarea/save_token/$1/$2';
$route['user/change-blog/(:any)/(:any)'] = 'userarea/change_blog/$1/$2';
$route['user/connect/(:any)'] = 'userarea/connect/$1';
$route['user/disconnect/(:num)'] = 'userarea/disconnect/$1';
$route['user/callback/(:any)'] = 'userarea/callback/$1';
$route['user/short-url/(:any)'] = 'userarea/short_url/$1';
$route['user/preview/(:any)'] = 'userarea/preview/$1';
$route['user/preview/(:any)/(:any)'] = 'userarea/preview/$1/$2';
$route['user/preview/(:any)/(:any)/(:any)/(:any)'] = 'userarea/preview/$1/$2/$3/$4';
$route['user/delete-post/(:num)'] = 'userarea/delete_post/$1';
$route['user/delete-post-rss/(:any)'] = 'userarea/delete_post_rss/$1';
$route['user/show-post/(:num)'] = 'userarea/show_post/$1';
$route['user/show-posts/(:num)'] = 'userarea/show_posts/$1';
$route['user/show-posts/(:num)/(:any)'] = 'userarea/show_posts/$1/$2';
$route['user/show-feed-posts/(:num)/(:num)'] = 'userarea/show_feed_posts/$1/$2';
$route['user/show-feeds/(:num)'] = 'userarea/show_feeds/$1';
$route['user/get-categories/(:any)/(:any)'] = 'userarea/get_categories/$1/$2';
$route['user/get-selected/(:any)'] = 'userarea/get_selected/$1';
$route['user/search-posts/(:any)'] = 'userarea/search_posts/$1';
$route['user/show-accounts/(:any)/(:num)'] = 'userarea/show_accounts/$1/$2';
$route['user/show-accounts/(:any)/(:num)/(:any)'] = 'userarea/show_accounts/$1/$2/$3';
$route['user/search-accounts/(:any)/(:any)'] = 'userarea/search_accounts/$1/$2';
$route['user/publish'] = 'userarea/publish';
$route['user/upimg'] = 'userarea/upimg';
$route['(:any)'] = 'userarea/short/$1';
$route['get-url-stats/(:any)'] = 'userarea/get_url_stats/$1';
$route['user/statistics/(:num)'] = 'userarea/get_statistics/$1';
$route['user/unconfirmed-account'] = 'userarea/unconfirmed_account';
$route['user/bookmark/(:any)'] = 'userarea/bookmark/$1';
$route['user/rss-settings/(:any)/(:num)/(:any)'] = 'userarea/rss_settings/$1/$2/$3';
$route['user/get-rss-stats/(:num)'] = 'userarea/get_rss_stats/$1';
$route['user/save-current-posts/(:any)'] = 'userarea/save_current_posts/$1';
$route['user/get-img'] = 'userarea/get_img';
$route['user/get-media/(:any)/(:num)'] = 'userarea/get_media/$1/$2';
$route['user/delete-media/(:num)'] = 'userarea/delete_media/$1';
$route['user/tickets'] = 'ticketsarea/my_tickets';
$route['user/new-ticket'] = 'ticketsarea/new_ticket';
$route['user/get-tickets/(:any)/(:any)'] = 'ticketsarea/get_tickets/$1/$2';
$route['user/get-ticket/(:num)'] = 'ticketsarea/ticket/$1';
$route['user/delete-ticket/(:num)'] = 'ticketsarea/delete_ticket/$1';
$route['user/questions/(:any)'] = 'ticketsarea/get_questions/$1';
$route['user/team'] = 'teams/team';
$route['user/show-members/(:num)'] = 'teams/show_members/$1';
$route['user/team-settings/(:any)'] = 'teams/team_settings/$1';
$route['user/team-settings/(:any)/(:num)'] = 'teams/team_settings/$1/$2';
$route['user/insights'] = 'insights/insights_page';
$route['user/insights/(:num)'] = 'insights/insights_page/$1';

// Admin routes
$route['admin/home'] = 'adminarea/dashboard';
$route['admin/auto-publish'] = 'adminarea/scheduled_posts';
$route['admin/publish-scheduled/(:num)'] = 'adminarea/publish_scheduled/$1';
$route['admin/publish-rss/(:num)'] = 'adminarea/publish_rss/$1';
$route['admin/publish-rss-posts/(:num)'] = 'adminarea/publish_rss_posts/$1';
$route['admin/notifications'] = 'adminarea/notifications';
$route['admin/users'] = 'adminarea/users';
$route['admin/tools'] = 'adminarea/tools';
$route['admin/bots'] = 'bots/manage_bots';
$route['admin/networks'] = 'adminarea/networks';
$route['admin/network/(:any)'] = 'adminarea/network/$1';
$route['admin/connect/(:any)'] = 'adminarea/connect/$1';
$route['admin/callback/(:any)'] = 'adminarea/callback/$1';
$route['admin/plans'] = 'adminarea/plans';
$route['admin/settings'] = 'adminarea/settings';
$route['admin/faq'] = 'adminarea/faq';
$route['admin/notification'] = 'adminarea/notification';
$route['admin/update'] = 'adminarea/update';
$route['admin/upnow'] = 'adminarea/upnow';
$route['admin/plan'] = 'adminarea/plan';
$route['admin/upnow/1'] = 'adminarea/upnow/$1';
$route['admin/get-notifications'] = 'adminarea/get_notifications';
$route['admin/get-notification/(:num)'] = 'adminarea/get_notification/$1';
$route['admin/del-notification/(:num)'] = 'adminarea/del_notification/$1';
$route['admin/delete-user/(:num)'] = 'adminarea/delete_user/$1';
$route['admin/update-user'] = 'adminarea/update_user';
$route['admin/search-users/(:num)/(:any)'] = 'adminarea/search_users/$1/$2';
$route['admin/show-users/(:num)/(:num)'] = 'adminarea/show_users/$1/$2';
$route['admin/show-users/(:num)/(:num)/(:any)'] = 'adminarea/show_users/$1/$2/$3';
$route['admin/user-info/(:num)'] = 'adminarea/user_info/$1';
$route['admin/new-user'] = 'adminarea/new_user';
$route['admin/get-plans'] = 'adminarea/get_plans';
$route['admin/get-plan/(:num)'] = 'adminarea/get_plan/$1';
$route['admin/delete-plan/(:num)'] = 'adminarea/delete_plan/$1';
$route['admin/create-user'] = 'adminarea/create_user';
$route['admin/statistics/(:num)'] = 'adminarea/get_statistics/$1';
$route['admin/option/(:any)'] = 'adminarea/set_option/$1';
$route['admin/option/(:any)/(:any)'] = 'adminarea/set_option/$1/$2';
$route['admin/upmedia'] = 'adminarea/upmedia';
$route['admin/tickets'] = 'ticketsarea/all_tickets';
$route['admin/get-ticket/(:num)'] = 'ticketsarea/ticket_info/$1';
$route['admin/delete-ticket/(:num)'] = 'ticketsarea/delete_ticket_as_admin/$1';
$route['admin/new-question'] = 'ticketsarea/new_question';
$route['admin/get-all-tickets/(:any)/(:any)'] = 'ticketsarea/get_all_tickets/$1/$2';
$route['admin/delete-question/(:num)'] = 'ticketsarea/delete_question/$1';
$route['admin/user-activities/(:num)'] = 'statistics/user_activities/$1';
$route['admin/user-data/(:num)/(:num)/(:num)'] = 'statistics/user_data/$1/$2/$3';
// Default
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
/* End of file routes.php */
/* Location: ./application/config/routes.php */