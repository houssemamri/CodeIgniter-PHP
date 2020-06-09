<?php
//die($_SESSION['language']);
if(!isset($_SESSION['language']))

    $lang = 'fr';

else

    $lang=$_SESSION['language'];

//$lang = "fr";

if(strcmp($lang,'en')==0)

{

    $welcome  = "Welcome";
    $profieHomeText = "Here you can modify the links to your review's sites";
    $manageAvatar = "Avatar configuration";
    $personnageSelection = "Select a character";
    $bubbleSelection = "Select a bubble";

    //Hotels
    $hotel=" HOTEL ";
    $resturant = "RESTURANT ";
    $tourism  = "TOURISM";
    $product  = "PRODUCT ";
    $service = "SERVICE ";
    /*index page*/

    $img1="1-eng.png";

    $img2="2-eng.png";

    $img3="3-eng.png";

    $img4="4-eng.png";

    $img5="5-eng.png";

    $img6="6-eng.png";

    $img7="7-eng.png";

    $img8="8-eng.png";



    /* Selection page */

    $welcome="Welcome";

    $welcomeMsg="Choose from any of the menu item above or checkout the tutorial.";

    $msgUsr="Nothing is more important than customization. Billions of possible answers are included in this software.";

    $sec1="Hotel";

    $sec2="Restaurant";

    $sec3="Leisure";

    $sec4="Culture";

    $sec5="Product";

    $sec6="Services";



    /*Language Page*/

    $generateMsg="Generate answers to reviews in one of the following languages. Modify them or write your own answer below.";

    $lang1="French";

    $lang2="English";

    $lang3="Spanish";



    $ans1="Answer to Positive Reviews";

    $ans2="Answer to Negative Reviews";

    $ans3="Answer to Positive Reviews(simple)";

    $reviewans1="https://review-thunder.com/assets/img/ENG - Positive Review.png";
    $reviewans2="https://review-thunder.com/assets/img/ENG - NEGATIVE REVIEW.png";
    $reviewans3="https://review-thunder.com/assets/img/ENG - Positive et simple review.png";

    $ansbox="AnsBox-eng.png";



    $sex1="Man";

    $sex2="Woman";

    $sex3="Unisex";

    $positive=array("Greeting","Thanks for choosing Us","Was it a nice time ?","Thanks for the Review","Preferred Part","Importance of Reviews","Follow us Online/Closing Sentence","Polite Ending");

    $negative=array("Greeting","Thanks for choosing Us","What happend?","Situation 1","Situation 2","Preferred Part","Situation 3","Situation 4","Explanations","Closing Sentence","Polite Ending");

    $simple=array("Greeting","Thank you for Coming","Thanks for the Review","Preferred Part","Closing Sentence","Polite Ending");



    //$generate="G�n�rer";

    $generateHeader="Answers to Reviews";


    $generateBox="Press Generate Button to get your result";

    $mailsendheader = "Personalise your answers";


    $sendMail="send-eng.png";



    $save="Save";



    /*Menu*/



    $home="Home";

    $article="Answer Reviews";

    $database="Database";

    $add="Add Data";

    $update="Update Data";

    $advice="Advices";

    $support="Support";

    $contact="Contact";

    $profile="Profile";

    $account="Account";

    $logout="Logout";

    $login="Conectarse";

    $manageAcc="Manage Account(s)";

    $changelang ="Languages";



    /*Upload Section*/

    $uploadWelcome="Choose from any of the options to upload your parts for any type of answers.";

    $uploadTitle="Upload";

    $uploadMsg="Upload your own parts to the possible answers";

    $uploadBtn="Upload";



    /*Update Section*/



    $updateWelcome="Choose from any of the options to update your parts for any possible answer present below.";

    $updateTitle="Update";

    $updateMsg="Update the different parts for the possible answers present below.";

    $select="Select";

    $updateBtn="Update";



    /*Support Section*/



    $supportTitle="Support";

    $supportMsg="Do you have any queries or need any support ? Shoot us a message Below !";

    $yourName="Your Name";

    $yourEmail="Your Email";

    $yourMessage="Your Message";

    $sendSupport="Send Enquiry";



    $contactInfo="Give us a call or send us an Email, we try to answer all enquiries within 24 hours on business days. <br /><br /> We are open from 9am to 6pm week days";



    /*Admin section*/



    $adminWelcome="Welcome to the Admin Panel";

    $adminHome="Home";

    $adminRegister="Register User";

    $adminBlog="Blog Admin Home";

    $adminSupport="Support Messages";

    $unreadMessage="unread Messages";

    $deleteUser="Delete Users";

    $read="Read";

    $unread="Unread";

    $mark="Mark as Read";



    /*Register User*/



    $register="Register";

    $registerName="Name";

    $registerCompany="Company";

    $registerPosition="Position";

    $registerEmail="Email";

    $registerContact="Contact";

    $registerPassword="Password";

    $registerBtn="Register";

    $registerBack="Back";



    /*Login Page*/



    $login="Login";

    $loginEmail="Email";

    $loginPassword="Password";

    $loginForgot="Forgot Password";

    $enterEmail="Enter Email Address";

    $sendEmail="Send Email";

    $loginBtn="Login";

    $rememberMe = "Remember Me";


    $checkEmail="Please check your mail for further instructions.";

    $changePassword="Click here to change your password:";



    $successChange="Successfully changed password";

    $updateDetail="Update Details";

    $changePwd="Change Password";

    $googleacc_access = "Google Account Access";
    $avatarTextAccountPre = " ";
    $client_idd ="Client ID";

    $client_secrett = "Client Secret";

    $retrievingIdToken="Retrieving An Id Token";

    $connectme ="Connect Me";

    /*User Profile*/



    $profile="Profile";

    $profileWelcome="Welcome to your user profile";

    $editProfile="Edit Profile";
    $avatarTextProfile = "";
    $editFacebookSetting = "Edit Facebook setting :";

    $editLinks="Edit Links";

    $saveLinks="Save Links";

    $saveBtn="Save Links";

    $newPwd="New Password";

    $uploadPic="Upload Profile Picture";

    $avatar = "Avatar";


    /*Site buttons */

    $copy="copy-en.png";

    $generate="generate-en.png";

    $booking="booking-en.png";

    $google="google-en.png";

    $lafour="lafour-en.png";

    $trip="trip-en.png";

    $yelp="yelp-en.png";



    /* Extras */

    $edit="Edit";

    $addItem="Add Item";

    $item="Item";

    $addbtn="Add";

    $clsbtn="Close";

    $addEmail="Add Email";

    $email="Email Address";

    $fname="First Name";

    $addList="Add List";

    $listname="List Name";

    $addList="Add List";

    $addtoExist="Add to Existing List";

    $listPresent="List Presents";

    $updateItem="Update Item";

    $confirm="Confirm Delete?";

    $editSMTP="Edit SMTP";

    $smtpHost="SMTP Host";

    $userName="User Name";

    $pwd="Password";

    $internet="Internet Service";

    $legal="Legal Mentions";

    $manageEmailList="Manage Email List";

    $sendEmails = "Send Emails";

    $listName="List Name";

    $manageEmail="Manage Email";

    $atLeastOne="Please select at least one Email";

    $subject="Subject";

    $savePrefer="Save Preference";

    $situationPrefer="Situation";

    $manage="Manage";

    $toDoList="todo-eng.png";

    $noItemPresent="No Item Present";

    $completedList="Completed List";

    $deleteOpt="Delete";

    $uploadMultiEmail="Upload Multiple Mail";

    $uploadExcel="Upload Excel";

    $userPrefer="User Preferences";

    $SMTPmsg="Please setup SMTP details for your account";

    $emailList="Email List";

    $Posts="Posts";

    $tools="Tools";

    $networks ="Networks";

    $Settings ="Settings";

    $my_business_account="My Business Account";

    $fIcon="Français";

    $sIcon="Espanol";



    $ourService = "Our Services";

    $serv1 = "eng.png";



    $todoName = "To Do List";

    $Situation = "Siutation";

    $saveSMTP = "Save Settings";

    $updateEmail = "Update Email";

    $loginFail = "<strong>Warning!</strong> Please enter the correct username/password and try again.";

    $addNewCompany = "Add New Company";

    $company = "Company";

    $updateDetails = "Update Details";



    /* Password forget details */

    $checkEmailForgot = "Please check your email for further instructions.";

    $wrongEmail = "Please input the correct mail address.";

    $passwordEmail = "Please change your password through following link.";

    $invalidEmail = "Please insert a valid email address.";

    $enterProper = "Please enter a proper password.";

    $passwordChangeSuccess = "Password has been changed successfully!";

    $passwordTryAgain = "Please try again.";



    $activity = "activity-eng.png";



    $readProfile = "Read";

    $answerProfile = "Answer";



    $successAdd = "New Company account created";



//Answer Reviews
    $answerReview = "Answer Review";
    $preference = "Preference";
    $accountPreferences = "Account Preferences";

//Increase Reviews
    $increaseReviews = "Increase Reviews";

//Contact List
    $contactList = "Contact List";

//Qr Code
    $qrcode = "QR Code";


//Emailing
    $viewEmailLog = "View Email Log";
    $smtpPrefer = "SMTP Preference";
    $emailing  = "Emailing";
    $selecttemplate = "Select Template";
    $emaillog = "Emailing Log";
    $modify = "Modify";
    $delete = "Delete";
//Video Reviews
    $videoReviews = "Video Reviews";

//SMS
    $sms = "SMS";
    $sendsms = "Send SMS";
//Promote Reviews
    $promoteReviews = "Promote Reviews";

//Post
    $Post = "Post";

//Add Email Template
    $add  			 = "Add";
    $edit			 = "Edit";
    $emailTemplate	 = "E-mail Template";
    $templateName	 = "Template Name";
    $templateBody 	 = "Template Code";
    $submit		 	 = "Submit";



//viewEmailTemplate
    $slNo 			= "Sl. No.";
    $templateName 	= "Template Name";
    $action 		= "Action";


//Send Email
    $chooseGroupName 	= "Choose Group Name";
    $chooseTemplate 	= "Choose Template";
    $templateChoose 	= "Select an Option";
    $subject			= "Subject";

//View Email Log
    $slNo  			= "Sl.No.";
    $group_Id 		= "Group";
    $email_Id 		= "Email List";
    $name			= "Name";
    $subject		= "Subject";
    $sendDate		= "Send Date";
    $sendTime		= "Send Time";
    $date_time      = "Date & Time";
    $send           = "send";
    $delete			= "Delete";
    //$change_sender_name = "Change".<br>."Name & Sender";

//Select EMail Template
    $change_template_name = "Change Template Name";
    $template_name = "Template Name";
    $new_template = "New Template";
    $schedule_email = "Schedule Emaill";
    $schedule_date = "Schedule Date";
    $schedule_time = "Schedule Time";
    $subject_email = "Subject";

//SMTP Preference
    $smtphey = "Hey";
    $smtpmsgg = "Here you can set up your Email and SMS preference. Your providers will happily give you these informations!";
    $smtp_email_preference = "Email Preferences:";
    $smtp_sms_preference = "SMS Preferences:";
    $credential_check   = "*check all the credential details you entered";
    $from_number = "From Number";
    $smtp_update = "Update";
//Send SMS
    $send_sms_greeting = "Great Idea! Why don't you send an SMS to incite your Clients to publish and online Review?";
    $send_sms_button = "SEND";
    $send_sms_table_mobile = "Mobile No";
    $send_sms_table_group = "Group Name";
    $send_sms_table_message = "Message";
    $send_sms_table_send_date = "Send Date";
    $send_sms_table_send_time = "Send Time";
    $send_sms_table_action = "Action";
//die("here2");
//QR Code
    $qrcode_welcome = "So";
    $avatarTextQr = "3, 2, 1 ….. Flash !";
    $avatarTextVideo = "Be sure to have your customer’s approval before  putting online their Video Reviews !";
    $avatarTextMainProfile = "The perfect management of your online reviews at only a few clicks away !";
    $avatarTextTodo = "A well Managed Schedule for a great Reputation !";

    $qrcode_welcome_msg = "Interested in creating a QR Code in order to increase your online Reviews ? You can then add it to your website, social networks, Business Cards and to many other places ! If you need help";
//TODO list
    $totohey = "Hey";
    $todo_greeting = "Here Are The Next Tasks You Need To Work On ! Why Don'T You Organise Yourself And Marvelously Manage Your Online Reviews";
    $duedate = "Due Date";
    $comment = "Comment";


    $profile_communication_exchange = "Communication Exchange History";
    $profile_last_email_sent= "Last Email Sent ";
    $profile_email_sent_subject = "Subject";
    $profile_last_sms_sent = "Last SMS Sent";
    $profile_todo_due_date = "Due Date";
    $profile_todo_comment = "Comment";

//Videos
    $manage_videos = "Manage";
    $manage_video_reviews = "Manage Your Video Reviews";
    $manage_videos_increase = "Increase";
    $share_videos = "Share On";
//Select Template Email
    $select_template_modal_heading = "Send Email";
    $select_template_email_id = "Email Id";
    $select_template_subject = "Subject";
    $select_template_template_name = "Template Name";
    $select_template_change_name = "Change Name";

//Profile Google
    $profile_google_greeting = "Hey";
    $profile_google_greeting_msg = "Here you can modify the Links to your Review's Sites!";
    $profile_google_save = "Save";

//Profile Facebook
    $profile_facebook_page_link = "Facebook Page Link";
    $profile_facebook_app_id = "Facebook App Id";
    $profile_facebook_app_secret_key = "Facebook App Secret Key";
    $profile_facebook_page_id = "Facebook Page Id";
    $profile_facebook_retrieving_id_token = "Retrieving An Id Token";
    $profile_facebook_update_details = "Update Details";
    $profile_facebook_connect_me = "Connect Me";

//Mangae Video Reviews
    $manage_video_reviews_heading = "Manage Your Video Reviews";
    $manage_video_reviews_category = "Category";
    $manage_video_reviews_Action = "Action";
    $manage_video_reviews_Action2 = "Action";


//Manaage Video Category
    $manage_video_add_category = "Add Category";
    $manage_video_add = "Add";
    $manage_video_category_close = "Close";
    $manage_video_add_category_placeholder = "Category Name";

//Manaage Video Edit Category
    $manage_video_edit_category = "Edit Category";
    $manage_video_edit = "Update";
    $manage_video_edit_category_close = "Close";
    $manage_video_edit_category_placeholder = "Category Name";


//Manage Video Delete Category
    $manage_vdeo_delte_msg = "Do you really want to delete it?";

    $uploadanswertext = "Add your own text inside the software";
    $updateanswertext = "Modify the texts inside the software";

    $managepreferwelcom = "From this page you can change the name of Buttons corresponding to the different situations you will face in your reviews. Each situation will correspond to a specific category of Text you can customise";
    $avatarTextManagePre = "Always more customisation possibilities ! The situation’s buttons are now adaptables to your needs ";
    $selectoption = "Select an Option";
    $subjectemail = "Subject";
    $newtemplate = "New Template";
    $avatarTextEmail = "Emailing - Some very precise rules exist ! Follow them for a maximum of results";
    $avatarTextSms = "Just like for emails, be sure you have the right to use their Phone numbers";
    $canceltemplate = "Cancel";
    $sendemail = "Send Email";
    $testemail = "Test Email";
    $scheduleemail = "Schedule Email";

    $welcomemanageacc = "Dear";
    $welcomemanageaccmsg = "Here are your Accounts ! For Any advices to Manage Them, Please Contact Us!";

    $selectlist = "Select List";

    $editvideo = "Edit Video";
    $cancelvideo = "Close";
    $updatevideo = "Update";
    $deletevideo = "Delete";

//Pricing page
    $features = 'Features';
    $features_below_text = "Discover all our Software's Possibilities and start managing your Reviews";
    $billions_of_possibilities = "Billions of Possibilities";
    $billions_of_possibilities_text = "Unique answers to your reviews which are adapted to many sectors of Activity";
    $main_review_sites_sector = "Main Review Sites & Sector";
    $main_review_sites_sector_text = "Publish your answers on many review sites like TripAdvisor, Google, Facebook, TheFork, ...";
    $customize_our_texts = "Customize our Texts";
    $customize_our_texts_text = "Want to adapt our Text to your Company's personality ? Use the proper tone ?";
    $add_your_texts = "Add Your Texts";
    $add_your_texts_text = "Include your own text inside our Software. Everything can be customized";
    $customize_everything = "Customize Everything";
    $customize_everything_text = "Customize the entire Answer review section of the Software to adapt to your clients";
    $contact_management = "Contact Management";
    $contact_management_text = "Manage your contact database in order to send email or sms to increase your reviews";
    $answer_directly = "Answer directly";
    $answer_directly_text = "Answer directly to your customers by Email or using any website";
    $email_templates = "Email Templates";
    $email_templates_text = "Increase your Reviews and personalise your Emails based on the desired type of Review";
    $send_emails = "Send Emails";
    $send_emails_text = "Schedule, test and optimise your email sending process to increase your reviews";
    $send_text_messages = "Send Text Messages";
    $send_text_messages_text = "Contact your Clients on their mobile to ask them for some reviews or Video Reviews";
    $advices = "Advices";
    $advices_text = "Regular Advices are published on our Blogs or can be obtained through our Support Page.";
    $video_reviews = "Video Reviews";
    $video_reviews_text = "Easy to Incite your clients to record Video Reviews and to share them online.";
    $month = "Month";
    $months = "Months";
    $other_services = "Other Services";
    $other_services_below_text = "Discover our Contracts without Commitments, our Reactivity and our Affordables Prices";
    $webmatkering_audit = "WebMatkering Audit";
    $webmatkering_audit_text = "Realisation of an Audit of your entire online presence and of its tools. We will then suggest a strategy to develop your online presence";
    $online_reviews = "Online Reviews";
    $online_reviews_text = "Complete Management of your Online Reviews (Analysis, Answer, Management, ...) In order to increase your clients database and their loyalty";
    $social_media = "Social Media";
    $social_media_text = "Facebook, Instagram, Linkedin, ... We manage your social presence from the redaction of your articles to the development of your communities";
    $seo_optimisation = "SEO Optimisation";
    $seo_optimisation_text = "SEO Optimisation of your website and possibility to have an Adwords presence.. Improve your position on Google !";
    $social_advertising = "Social Advertising";
    $social_advertising_text = "Boost your Articles and Your pages in order to develop your Communities and your Sales.. Affordable, your pages will be actives like never before !";
    $emailing_newsletter = "Emailing @ Newsletter";
    $emailing_newsletter_text = "Creation of your EMailing Campaigns and newsletter in order to develop your clients database and their loyalty !";
    $more_informations = "More Informations";
}

else if(strcmp($lang,'spa')==0)

{

    $welcome = "HOLA";
    $welcomemanageacc = "Hola";
    $welcomemanageaccmsg = "Aqui tienes tus diferentes cuentas!Si necesitas consejospara gestionarlos, puedes contactor nos!";
    $profieHomeText = "AQUI TIENES LA POSIBILIDAD DE MODIFICAR LAS DIRECCIONES DE TUS SITIOS DE CALIFICACIONES";
    $manageAvatar = "Configuración de avatar";
    $personnageSelection = "Selecciona un personaje";
    $bubbleSelection = "Selecciona una burbuja";
    //Hotels
    $hotel=" HOTEL ";
    $resturant = "RESTAURANTE ";
    $tourism  = "TOURISM";
    $product  = "PRODUCTOS ";
    $service = "SERVICIOS ";

    $avatar = "Avatar";

    /*index page*/

    $img1="1-spa.png";

    $img2="2-spa.png";

    $img3="3-spa.png";

    $img4="4-spa.png";

    $img5="5-spa.png";

    $img6="6-spa.png";

    $img7="7-spa.png";

    $img8="8-spa.png";



    /* Selection page */

    $welcome="Bienvenido";

    $welcomeMsg="Eliges uno de los elementos del menu o puedes nuestro tutorial.";

    $msgUsr="No hay nada de mas importante que la personalización. Solamente de respuestas unicas están incluidas dentro de este Aplicación.";

    $sec1="Hotel";

    $sec2="Restaurante";

    $sec3="Recreativa";

    $sec4="Cultura";

    $sec5="Productos";

    $sec6="Servicios";



    /*Language Page*/

    $generateMsg="Generar respuestas a tus revistas en las lenguas disponibles a bajo. Tienes la Posibilidad de modificar las o de escribir tus respuestas.";

    $lang1="Frances";

    $lang2="Ingles";

    $lang3="Español";



    $ans1="Respuesta Positiva";

    $ans2="Respuesta Negativa";

    $ans3="Respuesta Positiva y Simple";

    $reviewans1="https://review-thunder.com/assets/img/SPENISH - Positive answer.png";
    $reviewans2="https://review-thunder.com/assets/img/ESPANOL - Negative Review.png";
    $reviewans3="https://review-thunder.com/assets/img/Reponse Positive et simple.png";

    $ansbox="AnsBox-spa.png";



    $sex1="Hombre";

    $sex2="Mujer";

    $sex3="Unisex";

    $positive=array("Saludo","Gracias por Elegir nos","Como fue ?","Gracias por esta Revista","Parte Preferida","Importancia de las Revistas","Seguir nos (internet) /Otra phrase de conclusion","Fórmula de cortesía");

    $negative=array("Saludo","Gracias por Elegir nos","Que pasa?","Situación 1","Situación 2","Parte Preferida","Situación 3","Situación 4","Explicaciones","Phrase de conclusion","Fórmula de cortesía");

    $simple=array("Saludo","Gracias por tu Visita","Gracias por esta Revista","Parte Preferida","Phrase de conclusion","Fórmula de cortesía");

//Select EMail Template
    $change_template_name = "Nombre del Email";
    $template_name = "Nombre";
    $new_template = "Nuevo Email";
    $schedule_email = "Programar";
    $schedule_date = "Fecha";
    $schedule_time = "Hora";
    $subject_email = "Tema";





    //$generate="G�n�rer";

    $generateHeader="Respuestas a tus Revistas";

    $generateBox="Apretar el Botón Generar para tener sus Resultados";

    $mailsendheader = "Personalisez vos Réponses";


    $sendMail="send-spa.png";



    $save="Salvar";



    /*Menu*/



    $home="Página Principal";

    $article="Respuestas";

    $database="Datos";

    $add="Adición de Posibilidades";

    $update="Modificación de Posibilidades";

    $advice="Consejos";

    $support="Ayuda";

    $contact="Contacto";

    $profile="Perfil";

    $account="Cuenta";

    $manageAcc="Gestionar Cuenta";

    $logout="Cerrar Sesión";

    $login="Conectarse";

    $changelang ="Idiomas";



    /*Upload Section*/

    $uploadWelcome="Escoger una de las opciones para añadir sus partes a cada tipo de respuestas.";

    $uploadTitle="Cargar";

    $uploadMsg="Cargar tu propias partes a este base de datos";

    $uploadBtn="Cargar";



    /*Update Section*/



    $updateWelcome="Escoger una de las opciones para modificar sus partes y eso para cada tipo de respuestas.";

    $updateTitle="Modificación";

    $updateMsg="Modificar las Partes de los diferentes typos de Respuestas que puedes ver a bajo.";

    $select="Seleccionar";

    $updateBtn="Cargar";



    /*Support Section*/



    $supportTitle="Ayuda";

    $supportMsg="Tienes Preguntas o Necesitas informaciones ? Puedes Mandar nos un mensaje !";

    $yourName="Tu Apellido";

    $yourEmail="Dirección de Email";

    $yourMessage="Tu Mensaje";

    $sendSupport="Mandar Pregunta";



    $contactInfo="Puedes Contactarnos o llamarnos si necesitas Ayuda. Responderemos a sus preguntas en menos de las 24 horas. <br /><br /> Somos abiertos de las 9 a las 18 horas durante la semana";



    /*Admin section*/



    $adminWelcome="Bienvenido sobre este Panel de Administración";

    $adminHome="Página Principal";

    $adminRegister="Añadido de usuario";

    $adminBlog="Administrador de Blog";

    $adminSupport="Mensaje de Ayuda";

    $unreadMessage="Mensajes sin leer";

    $deleteUser="Suprimir Usuarios";

    $read="Leido";

    $unread="No Leido";

    $mark="Marcar como leido";



    /*Register User*/



    $register="Añadido de usuarios";

    $registerName="Apellido";

    $registerCompany="Empresa";

    $registerPosition="Puesto";

    $registerEmail="Email";

    $registerContact="Contacto";

    $registerPassword="Contraseña";

    $registerBtn="Registrarse";

    $registerBack="Regreso";



    /*Login Page*/



    $login="Conectarse";

    $loginEmail="Email";

    $loginPassword="Contraseña";

    $loginForgot="Contraseña Olvidada";

    $enterEmail="Direcciòn de Email";

    $sendEmail="Enviar el Email";

    $loginBtn="Conectarse";

    $rememberMe="Recuérdame";



    $checkEmail="Gracias por Verificar su Email para más instrucciones.";

    $changePassword="Hacer clic aquí para modificar la contraseña.";



    $successChange="Contraseña Cambiada";

    $updateDetail="Detalles de actualización";

    $changePwd="Cambiar Contraseña";

    $googleacc_access = "Acceso a la cuenta de Google";
    $avatarTextAccountPre = " ";
    $client_idd ="identificación del cliente";

    $client_secrett = "Secreto del cliente";

    $retrievingIdToken="Recuperar un token de identificación";

    $connectme ="Conectame";



    /*User Profile*/



    $profile="Perfil";

    $profileWelcome="Puedes elegir una de tus empresas";

    $editProfile="Modificar tu Perfil";

    $editFacebookSetting = "Editar configuración de Facebook :";

    $editLinks="Modificar Dirección Internet";

    $saveLinks="Salvar las Direcciones Internet";

    $saveBtn="Salvar URLs";

    $newPwd="Nueva Contraseña";

    $uploadPic="Cargar tu photo de perfil";





    /*Site buttons */

    $copy="copy-spa.png";

    $generate="generate-spa.png";

    $booking="booking-spa.png";

    $google="google-spa.png";

    $lafour="lafour-spa.png";

    $trip="trip-spa.png";

    $yelp="yelp-spa.png";



    /* Extras */

    $edit="Cambiar";

    $addItem="Anadir Elemento";

    $item="Elemento";

    $addbtn="Anadir";

    $clsbtn="Cerrar";

    $addEmail="Anadir Email";

    $email="Email Direccion";

    $fname="Nombre";

    $addList="Anadir Lista";

    $listname="Nombre De la Lista";

    $addList="Anadir Lista";

    $addtoExist="Anadir a una lista existente";

    $listPresent="Lista presente";

    $updateItem="Cambiar Elemento";

    $confirm="Confirmar Supresion?";

    $editSMTP="Cambiar SMTP";

    $smtpHost="SMTP";

    $userName="Usuario";

    $pwd="Contrasena";

    $internet="Servicios Internet";

    $legal="Menciones Legales";

    $manageEmailList="Gestionar Lista de Email";

    $sendEmails = "Envoi d'emails";

    $manageEmail="Gestionar Email";

    $atLeastOne="Por favor selectionas a lo menos un Email";

    $subject="Sujet";

    $savePrefer="Salvar Preferencia";

    $situationPrefer="Situacion";

    $manage="Gestionar";

    $toDoList="todo-spa.png";

    $noItemPresent="No Elemento presente";

    $completedList="Lista Acabada";

    $deleteOpt="Quitar";

    $uploadMultiEmail="Anadir Lista de Email";

    $uploadExcel="Anadir Documento Excel";

    $userPrefer="Usuario Preferencia";

    $SMTPmsg="Por Favor, Instalar tu informacion SMTP";

    $emailList="Lista de Email";

    $Posts="Mensajes";

    $tools ="Herramientas";

    $networks ="Redes";

    $Settings ="Ajustes";

    $my_business_account="Mi cuenta comercial";

    $ourService = "Servicos";

    $serv1 = "spa.png";



    $todoName = "Lista De Tareas";

    $Situation = "Siutation";

    $saveSMTP = "Salvar informaciones";

    $updateEmail = "Cambiar Email";

    $loginFail = "<strong>Attention!</strong> Merci D'Entrer Le Mot De Passe Correct.";

    $addNewCompany = "Add Company";

    $company = "Company";

    $updateDetails = "Cambiar Perfil";





    /* Password forget details */

    $checkEmailForgot = "Tienes que verificar tus email y seguir las instrucciones que vas se encontrar dentro.";

    $wrongEmail = "Tienes que utilisar una direcion email corecta.";

    $passwordEmail = "Gracias de Cambiar tu contrasena usando la direcion siguiente.";

    $invalidEmail = "Gracias por tratar de incluir una direcion email corecta.";

    $enterProper = "Please enter a proper password.";

    $passwordChangeSuccess = "Gracias! Hemos cambiado tu contrasena";

    $passwordTryAgain = "Puedes tratar de Nuevo por favor?";



    $activity = "activity-spa.png";



    $readProfile = "Leer";

    $answerProfile = "Respuesta";

    $successAdd = "Nueva Cuenta de Empresa creada";

//Answer Reviews
    $answerReview = "Respuesta Revisión";
    $preference   = "Preferencia";
    $accountPreferences = "Preferencias de la cuenta";

//Increase Reviews
    $increaseReviews = "Aumentar Opiniones";

//Contact List
    $contactList = "Lista de contactos";

//Profile
    $profile_Welcome = "Welcome";
    $profile_greeting = "Start your work with some Advices ! If you need more don't heistate to contact us
	<i class='em em-slightly_smiling_face'></i> !";

    //Qr Code
    $qrcode = "Código QR";
    //Emailing
    $viewEmailLog = "Ver el registro de correo electrónico";
    $smtpPrefer = "Preferencia SMTP";
    $emailing = "Correo electrónico";
    $selecttemplate = "Elegir Tema de Email";
    $emaillog = "Historico de tus Emails";
    $modify = "Modificar";
    $delete = "Supimir";
    //Video Reviews
    $videoReviews = "Reseñas de videos";

    //SMS
    $sms = "SMS";
    $sendsms = "Mandar SMS";
    //Promote Reviews
    $promoteReviews = "Promocionar Comentarios";

    //Post
    $Post = "Enviar";

    //Add Email Template
    $add 			 = "Añadir";
    $edit			 = "Editar";
    $emailTemplate	 = "Plantilla de correo electr�nico";
    $templateName	 = "Nombre de la plantilla";
    $templateBody	 = "Código de plantilla";
    $submit		 	 = "Enviar";


    //viewEmailTemplate
    $slNo 			= "Sl. No.";
    $templateName 	= "Nombre de la plantilla";
    $action 		= "Acción";

    //Send Email
    $chooseGroupName  = "Elija el nombre del grupo";
    $chooseTemplate = "Elegir la plantilla";
    $templateChoose = "Seleccione una opcion";
    $subject		= "Tema";

    //View Email Log
    $slNo  			= "Si. No.";
    $group_Id 		= "Grupo";
    $name 			= "Nombre";
    $email_Id 		= "Lista de correo";
    $subject		= "Tema";
    $sendDate		= "Fecha de envío";
    $sendTime		= "Tiempo de envío";
    $date_time 		= "Fecha y hora";
    $send			= "Mandar";
    $delete			= "borrar";

//SMTP Preference
    $hey = "HOLA ";
    $smtpmsgg = "Aqui Tienes La Posibilidad De Personalizar Tus Informaciones Email I Sms. Tus Operadores Pueden Dar Te Estas Informaciones Muy Facilmente !";
    $smtp_email_preference = "PREFERENCIAS EMAIL:";
    $smtp_sms_preference = "PREFERENCIAS SMS:";
    $credential_check = "*VERIFICAR LAS INFORMACIONES";
    $from_number = "NUMERO DE TELEFONO";
    $smtp_update = "ACTUALIZAR";
//Send SMS
    $send_sms_greeting = "Buena Idea ! Porque No Mandas Un Sms Para Alentar Tu Clientes A Publicar Una Calificacion!";
    $send_sms_button = "MANDAR";
    $send_sms_table_mobile = "Num mobile";
    $send_sms_table_group = "Nombre del grupo";
    $send_sms_table_message = "Mensaje";
    $send_sms_table_send_date = "Fecha de envio";
    $send_sms_table_send_time = "Hora de envio";
    $send_sms_table_action = "Accion";
//QR Code
    $qrcode_welcome = "Entonces";
    $avatarTextMainProfile = "La gestión perfecta de sus comentarios de clientes en unos pocos clics.";
    $avatarTextQr = "3, 2, 1 ….. Flash !";
    $avatarTextTodo = "Un horario bien administrado para una reputación de calidad.";

    $avatarTextVideo = " ¡Tenga cuidado de tener los permisos escritos de tus clientes antes de publicar sus Reseñas de video!";
    $qrcode_welcome_msg = "Te gustaria creer un Codigo QR  para aumentar tus calificaciones ?  Despues, tienes la posibilidad de poner lo sobre to sitio internet, tus redes sociales, tu tarjeta de visita i sobremuchas otras";
//TODO list
    $totohey = "";
    $todo_greeting = "Aqui tienes las proximas tareas que debes hacer ! estamos seguro que tu trabajo sera maravilloso !";
    $duedate = "Fecha de completaction";
    $comment = "Commentario";
//Profile
    $profile_Welcome = "Bienvenido";
    $profile_greeting = "Primeramente empezamos con consejos para descubrir las enormas posibilidades de calificaciones !";
    $profile_communication_exchange = "Historia de tus comunicaciones";
    $profile_last_email_sent= "Ultima email mandado ";
    $profile_email_sent_subject = "Tema";
    $profile_last_sms_sent = "Ultima email mandado";
    $profile_todo_due_date = "Fecha final";
    $profile_todo_comment = "Comentario";
//Videos
    $manage_videos = "Gestionar";
    $manage_video_reviews = "Gestionar tus calificaciones videos";
    $manage_videos_increase = "Aumentar";
    $share_videos = "Compartir";

    $editvideo = "Modificar Video";
    $cancelvideo = "Cerrar";
    $updatevideo = "Salvar";
    $deletevideo = "Suprimir";



//Select Template Email
    $select_template_modal_heading = "Mandar email";
    $select_template_email_id = "Email id";
    $select_template_subject = "Tema";
    $select_template_template_name = "Nombre";
    $select_template_change_name = "Cambiar nombre";

//Profile Google
    $profile_google_greeting = "";
    $profile_google_greeting_msg = "Aqui tienes la posibilidad de modificar las direciones de tus sitios de calificaciones";
    $profile_google_save = "Salvar";
//Profile Facebook
    $profile_facebook_page_link = "Direccion de pagina facebook";
    $profile_facebook_app_id = "Id de tu applicacion facebook";
    $profile_facebook_app_secret_key = "Llave secreta  de tu applicacion facebook";
    $profile_facebook_page_id = "Id de pagina facebook";
    $profile_facebook_retrieving_id_token = "Recuperar el id token";
    $profile_facebook_update_details = "Actualizar informaciones";
    $profile_facebook_connect_me = "Conexion";

//Mangae Video Reviews
    $manage_video_reviews_heading = "Gestionar tus calificaciones videos";
    $manage_video_reviews_category = "Categoria";
    $manage_video_reviews_Action = "Modificar";
    $manage_video_reviews_Action2 = "Suprimir";

//Manaage Video Category
    $manage_video_add_category = "Anadir categoria";
    $manage_video_add = "Anadir";
    $manage_video_category_close = "Cerrar";
    $manage_video_add_category_placeholder = "Nombre de la categoria";

//Manaage Video Edit Category
    $manage_video_edit_category = "Modificar este categoria";
    $manage_video_edit = "Modificar";
    $manage_video_edit_category_close = "Cerrar";
    $manage_video_edit_category_placeholder = "...";

//Manage Video Delete Category
    $manage_vdeo_delte_msg = "Realmente quieres suprimir este ?";

    $uploadanswertext = "Anadir tus textos dentro de esta solucion";
    $updateanswertext = "Modificar los textos dentro de esta solucion";
    $managepreferwelcom = "Desde esta pagina puedes cambiar el nombre de los botones que coresponden a las differentes situaciones que vas a encontrar en tus calificaciones. Cada situacion representa una categoria de texto que puedes modificar";
    $avatarTextManagePre = "¡Siempre más personalización ! Los botones de situación se adaptan a sus necesidades.";
    $selectoption = "Eegir opcion";
    $subjectemail = "Sujeto";
    $newtemplate = "Nueva presentacion";
    $avatarTextEmail = "Emailing - Existen reglas muy precisas! Siga para obtener los máximos resultados";
    $avatarTextSms = " Al igual que con los correos electrónicos, asegúrese de tener derecho a usar sus números de teléfono";
    $canceltemplate = "Cerrar";

    $sendemail = "Mandar";
    $testemail = "Tratar este Email";
    $scheduleemail = "Programar Email";

    $selectlist = "Elegir lista";

//Pricing page
    $features = 'Funcionalidades';
    $features_below_text = "Descubres todas las posibilidades de nuestra solucion y empezas a responder a tus comentarios";
    $billions_of_possibilities = "Biliones dePosibilidades";
    $billions_of_possibilities_text = "Respuestas unicas y adaptadas a tus comentarios & sector de Actividad";
    $main_review_sites_sector = "Principales Sitios & Actividades";
    $main_review_sites_sector_text = "Publicar Respuestas sobre los principales sitios como TripAdvisor, Google, Facebook, TheFork, ...";
    $customize_our_texts = "Personalizar tus textos";
    $customize_our_texts_text = "Quieres adaptar tus textos a la personalidad de tu empresa y a su cultura ?";
    $add_your_texts = "Anadir Tus textos";
    $add_your_texts_text = "Anadir tus Textos dentro de nuestra solucion. Puedes personalizar TODO";
    $customize_everything = "Personalizar TODO";
    $customize_everything_text = "Personalisar la parte de nuestra solucion que trata de comentarios y de Respuestas";
    $contact_management = "Gestion de Contactos";
    $contact_management_text = "Gestion de tus contactos para tener la posibilidad de mandar Emails y Textos.";
    $answer_directly = "Respuestar Directamente";
    $answer_directly_text = "Puedes responder directamente a tus clientes utilisando tu Email o SMS";
    $email_templates = "Tema de Email";
    $email_templates_text = "Personalisar Emails a los sitios que te interesan para aumentar comentarios de tus clientes sobre este sitios.";
    $send_emails = "Mandar Emails";
    $send_emails_text = "Programacion de Emails y posibilidad de testar los facilmente";
    $send_text_messages = "Mandar Mensajes";
    $send_text_messages_text = "Mandar un Sms a tus CLientes para mandar un comentario normal o un comentario video.";
    $advices = "Consejos";
    $advices_text = "Consejos publicados sobre nuestro Blog para ayudar te. Puedes tambien contactar nos para ayuda.";
    $video_reviews = "Calificaciones Videos";
    $video_reviews_text = "Incitar tus clientes a mandar te calificaciones videos para publicar las sobre tu sitios y redes sociales";
    $month = "Mes";
    $months = "Meses";
    $other_services = "Otros Servicios";
    $other_services_below_text = "Descubres nuestros Contractos sin Compromiso, nuestra reactiidadi nuestros precios baratos";
    $webmatkering_audit = "Audit WebMatkering";
    $webmatkering_audit_text = "Realisacion de una analisis de tu presencia internet y de tus instrumientos para tener una estrategia internet adecuada a tu empresa";
    $online_reviews = "Calificaciones de Clientes";
    $online_reviews_text = "Gestion Completa de tus comentarios de Clientes (Analisis, Respuesta, Gestion, Promocion) para aumentar tus clientes y sus fidelidades. ";
    $social_media = "Redes Sociales";
    $social_media_text = "Desarollar tus Comunidades utilisando publicaciones de cualidad, Comunicando sobre otras paginas y grupos ! Hacemos TODO para que tienes una presencia internet perfecta !";
    $seo_optimisation = "Estrategia SEO";
    $seo_optimisation_text = "Optimisacion SEO de tu Sitio internet  y trabajo Adwords para mejorar tu posicion sobre Google i tus ventas !";
    $social_advertising = "Publicidad Internet y Social";
    $social_advertising_text = "Publicidad de tus Articulos y paginas sobre los diferentes redes sociales para aumentar tus resultados y
 comunidades";
    $emailing_newsletter = "Emailing @ Newsletter";
    $emailing_newsletter_text = "Realisacion de Emailing y de Newsletter para aumentar tus clientes, sus fidelidades i sus ventas !";
    $more_informations = "Mas Informaciones!";




}

else

{

    $welcome = "SALUT"	;
    $welcomemanageacc = "Salut"	;
    $welcomemanageaccmsg = "Voici vos differents comptes!Si vous avez besoin de coneils quant a leur gestion,contactez nous!";
    $profieHomeText = "ICI TU PEUX MODIFIER LES LIENS DE TES SITES D'AVIS";
    $avatar = "Avatar";
    $personnageSelection = "Sélectionner un personnage";
    $bubbleSelection = "Sélectionner une bulle";

    //Hotels
    $hotel=" HOTEL ";
    $resturant = "RESTAURANT ";
    $tourism  = "TOURISM";
    $product  = "PRODUITS ";
    $service = "SERVICES ";


    /*index page*/

    $img1="1-fr.png";

    $img2="2-fr.png";

    $img3="3-fr.png";

    $img4="4-fr.png";

    $img5="5-fr.png";

    $img6="6-fr.png";

    $img7="7-fr.png";

    $img8="8-fr.png";



    /* Selection page */

    $welcome="Bienvenue";

    $welcomeMsg="Merci de Choisir une des activités ou de vous reporter au tutoriel.";

    $msgUsr="Rien n'est plus important que la personnalisation. Toutes nos réponses sont uniques et modifiables";

    $sec1="Hôtel";

    $sec2="Restaurant";

    $sec3="Loisirs";

    $sec4="Culture";

    $sec5="Produits";

    $sec6="Services";



    /*Language Page*/

    $generateMsg="Générer des réponses à vos commentaires dans les langues disponibles. Modifiez les ou écrivez les ci-dessous.";

    $lang1="Français";

    $lang2="Anglais";

    $lang3="Espagnol";



    $ans1="Réponse Avis Positif";

    $ans2="Réponse Avis Négatif";

    $ans3="Réponse Positive Simple";

    $reviewans1="https://review-thunder.com/assets/img/FRENCH - Réponse positive.png";
    $reviewans2="https://review-thunder.com/assets/img/FRENCH - Negative review.png";
    $reviewans3="https://review-thunder.com/assets/img/FRENCH - Réponse positive et simple.png";

    $ansbox="AnsBox-fr.png";



    $sex1="Homme";

    $sex2="Femme";

    $sex3="Unisexe";

    $positive=array("Salutation","Merci du Choix","Bien passé?","Merci pour l'avis","Partie Préférée","Importance des Avis","Suivi Internet ou Autre Cloture","Formule de politesse");

    $negative=array("Salutation","Merci du Choix","Que s'est il passé?","Situation 1","Situation 2","Partie Préférée","Situation 3","Situation 4","Explication","Cloture","Formule de politesse");

    $simple=array("Salutation","Merci d'être venu","Merci pour l'avis","Partie Préférée","Cloture","Formule de politesse");



    //$generate="G�n�rer";

    $generateHeader="Réponses aux Avis";

    $generateBox="Appuyer sur le Bouton Générer pour avoir vos Résultats";

    $mailsendheader = "Personalisas tus Respuestas";

    $sendMail="send-fr.png";



    $save="Sauvegarder";



    /*Menu*/



    $home="Accueil";

    $article="Répondre aux Avis";

    $database="Données";

    $add="Ajout Données";

    $update="Modification Données";

    $advice="Conseils";

    $support="Support";

    $contact="Contact";

    $profile="Profil";

    $account="Compte";

    $manageAcc="Gestion Comptes";

    $logout="Se Déconnecter";

    $login="Se Connecter";

    $changelang ="Langues";



    /*Upload Section*/

    $uploadWelcome="Choisir une des Options pour ajouter vos parties à chacune des possibilités de réponse.";

    $uploadTitle="Charger";

    $uploadMsg="Charger vos Propres Parties aux Réponses Possibles";

    $uploadBtn="Charger";



    /*Update Section*/



    $updateWelcome="Choisir une des options pour modifier vos parties et cela pour chacune des possibilités de réponse.";

    $updateTitle="Modification";

    $updateMsg="Modifier les différentes parties des différents types de réponses cidessous.";

    $select="Sélectionner";

    $updateBtn="Charger";



    /*Support Section*/

    $manageAvatar = "Configuration d'avatar";

    $supportTitle="Soutien";

    $supportMsg="Vous avez des questions ou avez besoin d'aide ? envoyez nous un message !";

    $yourName="Votre Nom";

    $yourEmail="Votre Adresse Email";

    $yourMessage="Votre Message";

    $sendSupport="Envoyer Question";



    $contactInfo="Appelez nous ou passez nous voir quand bon vous semble. nous répondrons à vos questions en moins de 24h. <br /><br /> nous sommes ouverts de 9h à 18h en semaine";



    /*Admin section*/



    $adminWelcome="Bienvenue sur le Panel d'Administration";

    $adminHome="Accueil";

    $adminRegister="Ajout d'Utilisateur";

    $adminBlog="Administrateur du Blog";

    $adminSupport="Messages de Support";

    $unreadMessage="Messages non lus";

    $deleteUser="Supprimer Utilisateurs";

    $read="Lu";

    $unread="Non Lu";

    $mark="Marqué comme Lu";



    /*Register User*/



    $register="Enregistrement Utilisateur";

    $registerName="Nom";

    $registerCompany="Entreprise";

    $registerPosition="Poste";

    $registerEmail="Email";

    $registerContact="Contact";

    $registerPassword="Mot de Passe";

    $registerBtn="S'Enregistrer";

    $registerBack="Retour";



    /*Login Page*/



    $login="Se Connecter";

    $loginEmail="Email";

    $loginPassword="Mot de Passe";

    $loginForgot="Mot de Passe Oublié";

    $enterEmail="Entrer Adresse Email";

    $sendEmail="Envoyer l'Email";

    $loginBtn="Se Connecter";

    $rememberMe="Souviens-toi de moi";


    $checkEmail="Merci de Vérifier votre Email pour plus d'instructions.";

    $changePassword="Cliquer ici pour modifier le mot de passe.";

    $canceltemplate = "Fermer";


    $successChange="Mot de Passe changé avec succès";

    $updateDetail="Détails de la mise à jour";

    $changePwd="Changer Mot de Passe";

    $googleacc_access = "Accès au compte Google";
    $avatarTextAccountPre = "";
    $client_idd ="identité du client";

    $client_secrett = "Secret du client";

    $retrievingIdToken="Récupération d'un jeton d'identification";

    $connectme ="Me connecter";



    /*User Profile*/



    $profile="Profil";

    $profileWelcome="Bienvenue sur votre Profil";

    $editProfile="Modifier le profil";

    $editFacebookSetting= "Modifier les paramètres Facebook :";

    $editLinks="Modifier les Liens";

    $saveLinks="Sauvegarder les Liens";

    $saveBtn="Sauver les liens";

    $newPwd="Nouveau mot de passe";

    $uploadPic="Charger la photo de profil";



    /*Site buttons */

    $copy="copy-fr.png";

    $generate="generate-fr.png";

    $booking="booking-fr.png";

    $google="google-fr.png";

    $lafour="lafour-fr.png";

    $trip="trip-fr.png";

    $yelp="yelp-fr.png";



    /* Extra */

    $edit="Modifier";

    $addItem="Anadir Elemento";

    $item="élément";

    $addbtn="Ajouter ";

    $clsbtn="Fermer";

    $addEmail="Ajouter Email";

    $email="Adresse Email";

    $fname="Prénom";

    $addList="Ajout Nouvelle Liste";

    $listname="Nom de la Liste";

    $addList="Ajouter Liste";

    $addtoExist="Ajout à une Liste Existante";

    $listPresent="Listes Présentes";

    $updateItem="Cambiar Elemento";

    $confirm="Confirmer Suppression?";

    $editSMTP="Modification SMTP";

    $smtpHost="Hôte SMTP";

    $userName="Nom d'Utilisateur";

    $pwd="Mot de Passe";

    $internet="Services Internet";

    $legal="MENTIONS LÉGALES";

    $manageEmailList="Gérer Listes d'Emails";

    $sendEmails = "Envoi d'emails";

    $manageEmail="Gestion Emails";

    $atLeastOne="Por favor selectionas a lo menos un Email";

    $subject="Tema";

    $savePrefer="Sauvegarder";

    $situationPrefer="Situation";

    $manage="Gérer";

    $toDoList="todo-fr.png";

    $noItemPresent="Aucunes Tâches présentes";

    $completedList="Travail Réalisé";

    $deleteOpt="Supprimer";

    $uploadMultiEmail="Charger une Liste d'Email";

    $uploadExcel="Charger Le Documento Excel";

    $userPrefer="Préférences";

    $SMTPmsg="Merci de mettre à jour les Données SMTP de votre Compte";

    $emailList="Liste Email";

    $Posts="Des postes";

    $tools ="Outils";

    $networks ="Les réseaux";

    $Settings ="Paramètres";

    $my_business_account="Mon compte d'entreprise";



    $ourService = "Nos Services";

    $serv1 = "fr.png";



    $todoName = "To Do Liste";

    $Situation = "Situation";

    $saveSMTP = "Sauvegarder Configuration";

    $updateEmail = "Modification Email";

    $loginFail = "<strong>Attention!</strong> Merci D'Entrer Le Mot De Passe Correct.";

    $addNewCompany = "Ajout Enterprise";

    $company = "Enterprise";

    $updateDetails = "Enregistrer Modifications";



    /* Password forget details */

    $checkEmailForgot = "Merci de vérifier vos e-mails et d'y suivre les instructions complémentaires.";

    $wrongEmail = "Merci d'utiliser une adresse email correcte.";

    $passwordEmail = "Merci de changer votre mot de passe en utilisant le lien suivant.";

    $invalidEmail = "Merci d'insérer une adresse e-mail valide.";

    $enterProper = "Please enter a proper password.";

    $passwordChangeSuccess = "Votre mot de passe a été changé avec succès!";

    $passwordTryAgain = "Merci de réessayer.";



    $activity = "activity-fr.png";



    $readProfile = "Lecture";

    $answerProfile = "Réponse";



    $successAdd = "Nouveau Compte d'entreprise Créé";

    //Answer Reviews
    $answerReview ="Répondre à vos Avis";
    $preference  = "Préférences";
    $accountPreferences = "Préférences de compte";

    //Increase Reviews
    $increaseReviews = "Augmenter les avis";

    //Contact List
    $contactList = "Liste de contacts";


    //QR Code
    $qrcode = "QR Code";
    //Emailing
    $viewEmailLog= "Voir le journal des courriels";
    $smtpPrefer  = "Préférences SMTP";
    $emailing    = "Emailing";
    $selecttemplate = "Choix Thème Email";
    $emaillog = "Historique d'E-mailing";
    $modify = "Modifier";
    $delete = "Supprime";
    //Video Reviews
    $videoReviews = "Avis vidéo";

    //SMS
    $sms = "SMS";
    $sendsms = "Envoi SMS";
    //Promote Reviews
    $promoteReviews = "Promouvoir les avis";

    //Post
    $Post = "Poster";

//Add Email Template
    $add  			 = "Ajouter vos données";
    $edit			 = "modifier";
    $emailTemplate	 = "Modèle de courrier électronique";
    $templateName	 = "Nom du modèle";
    $templateBody 	 = "Corps de modèle";
    $submit		 	 = "Soumettre";

//Send Email
    $chooseGroupName  = "Choisissez le nom du groupe";
    $chooseTemplate   = "Choisir le modèle";
    $templateChoose   = "Sélectionner une option";
    $subject	      = "Assujettir";

//viewEmailTemplate
    $slNo 			= "Sl. Non.";
    $templateName 	= "Nom du modèle";
    $action 		= "action";

//View Email Log
    $slNo  			= "Sl.No.";
    $group_Id 		= "Groupe";
    $name  			= "prénom";
    $email_Id 		= "Liste de courrier électronique";
    $subject		= "Assujettir";
    $sendDate		= "Envoyer la date";
    $sendTime		= "Heure d'envoi";
    $date_time		= "Date et heure";
    $send 			= "Envoyer";
    $delete			= "effacer";


//Select EMail Template
    $change_template_name = "Nom de l'Email";
    $template_name = "Nom";
    $new_template = "Nouvel Email";
    $schedule_email = "Programmer";
    $schedule_date = "Date";
    $schedule_time = "Heure";
    $subject_email = "Sujet ";
//SMTP Preference

    $smtphey = "Salut";
    $smtpmsgg = "Ici tu peux paramètres tes préférences email et sms. tes opérateurs te donneront ces informations avec plaisir !";
    $smtp_email_preference = "Préférences Email:";
    $smtp_sms_preference = "Préférences Sms:";
    $credential_check = "*Vérifiez toutes les informations";
    $from_number = "Numéro De Téléphone";
    $smtp_update = "Actualiser";

//Send SMS

    $send_sms_greeting = "Super idée ! pourquoi n'envois tu pas un sms pour inciter tes clients à publier un avis !";
    $send_sms_button = "Envoyer";
    $send_sms_table_mobile = "Num Mobile";
    $send_sms_table_group = "Nom Du Groupe";
    $send_sms_table_message = "Message";
    $send_sms_table_send_date = "Date D'Envoi";
    $send_sms_table_send_time = "Heure D'Envoi";
    $send_sms_table_action = "Action";
    $qrcode_welcome = "Alors";
    $avatarTextVideo = "Attention à bien avoir les autorisations écrites des clients avant de publier leurs Avis vidéos ! ";
    $avatarTextQr = " 3, 2, 1, ….. Flashez !";
    $avatarTextMainProfile = "La Gestion parfaite de vos Avis clients en quelques clics";
    $avatarTextTodo = "Un Planning bien géré pour une Réputation de qualité ";
    $qrcode_welcome_msg = "Serais tu intéressé par la création d'un QR Code afin d'Augmenter tes Avis Clients ? Ensuite tu pourras le mettre sur ton site internet, tes réseaux sociaux, tes cartes de visites et du multiples";
//TODO list
    $totohey = "Hey";
    $todo_greeting = "Voici vos futures taches !  organisez vous bien et faites des merveilles en matiére de gestion de vos avis clients !";
    $duedate = "Date de rendu";
    $comment = "Commentare";
//Profile
    $profile_Welcome = "Bienvenue ";
    $profile_greeting = "Tout d'abord, commencez par quelques conseils et découvrez les énormes possibilités offertes par le managementdes avis clients !";
    $profile_communication_exchange = "Historique Des échanges";
    $profile_last_email_sent= "Dernier Email Envoyé";
    $profile_email_sent_subject= "Sujet ";
    $profile_last_sms_sent = "Dernier Email Envoyé";
    $profile_todo_due_date = "Date Limite";
    $profile_todo_comment = "Commentaire";

//Videos
    $manage_videos = "Gérer";
    $manage_videos_increase = "Augmenter";
    $manage_video_reviews = "Gérer Vos Avis Vidéos";
    $share_videos = "Partager";
//Select Template Email
    $select_template_modal_heading = "Envoi Email";
    $select_template_email_id = "Email Id";
    $select_template_subject = "Sujet";
    $select_template_template_name = "Nom";
    $select_template_change_name = "Changer Le Nom";

//Profile Google
    $profile_google_greeting = "Et";
    $profile_google_greeting_msg = "Ici tu peux modifier les liens de tes sites d'avis clients !";
    $profile_google_save = "Sauver";


//Profile Facebook
    $profile_facebook_page_link = "Lien De Page Facebook";
    $profile_facebook_app_id = "Id D'Application Facebook";
    $profile_facebook_app_secret_key = "Clef Secrète De L'Application Facebook";
    $profile_facebook_page_id = "Id Page Facebook";
    $profile_facebook_retrieving_id_token = "Recupérer L'Id Token";
    $profile_facebook_update_details = "Actualiser Informations";
    $profile_facebook_connect_me = "Connexion";

//Mangae Video Reviews
    $manage_video_reviews_heading = "Gérer Vos Avis Vidéos";
    $manage_video_reviews_category = "Catégorie";
    $manage_video_reviews_Action = "Modifier";
    $manage_video_reviews_Action2 = "Supprimer";

//Manaage Video Category
    $manage_video_add_category = "Ajout De Catégorie";
    $manage_video_add = "Ajouter";
    $manage_video_category_close = "Fermer";
    $manage_video_add_category_placeholder = "Nom De La Catégorie";


//Manaage Video Edit Category
    $manage_video_edit_category = "Modifier La Catégorie";
    $manage_video_edit = "Modifier";
    $manage_video_edit_category_close = "Fermer";
    $manage_video_edit_category_placeholder = "Défaut";



//Manage Video Delete Category
    $manage_vdeo_delte_msg = "Voulez Vous Vraiment Supprimer Cela ?";

    $uploadanswertext = "Ajoutez vos propres textes au sein du logiciel";
    $updateanswertext = "Modifiez les textes au sein du logiciel";
    $managepreferwelcom = "De cette page,tu peux changer le nom des buttons correspondant aux differentes situations aux quelles vous devrez faire face au sein de vos avis. Chaque situation correspondra a une catégorie spécifique de texte que vous pourrez personnaliser";
    $avatarTextManagePre = "Toujours plus de personalisation ! Les boutons de situations sont adaptables à vos besoins";
    $selectoption = "Sélectionner l'Option";
    $subjectemail = "Sujet";
    $newtemplate = "Nouveau Theme";
    $avatarTextEmail = "Emailing - Des règles très précises existent ! Suivez les pour un Maximum de résultats";
    $avatarTextSms = "Comme pour les Emails, attention à la CNIL !";
    $sendemail = "Envoyer";
    $testemail = "Tester l'Email";
    $scheduleemail = "Programmer Email";

    $selectlist = "Choisir Liste";

    $editvideo = "Modifier Vidéo";
    $cancelvideo = "Fermer";
    $updatevideo = "Sauvegarder";
    $deletevideo = "Supprimer";


//Pricing page
    $features = 'Fonctionnalités';
    $features_below_text = "Découvrez toutes les possibilités de notre Logiciel et commencez à gérer vos Avis !";
    $billions_of_possibilities = "Milliards de Possibilités";
    $billions_of_possibilities_text = "Des réponses uniques à vos Avis pour plusieurs secteur d'activité";
    $main_review_sites_sector = "Principaux Sites & Activités";
    $main_review_sites_sector_text = "Des Réponses pours principales Activités et Sites TripAdvisor, Google, Facebook, LaFourchette, ...";
    $customize_our_texts = "Personnalisez vosTextes";
    $customize_our_texts_text = "Vous souhaitez adapter nos textes à votre personalité ? Utiliser le bon ton ? ";
    $add_your_texts = "Ajoutez vos textes";
    $add_your_texts_text = "Ajoutez vos propres textes au sein du logiciel. TOUT est personnalisable";
    $customize_everything = "Personnalisez TOUT";
    $customize_everything_text = "TOUTE la partie Gestion des Réponses du logiciel est personnalisable";
    $contact_management = "Management de Contacts";
    $contact_management_text = "Gérer vos Bases de contacts pour ensuite leur demander de publier un Avis";
    $answer_directly = "R�pondez en Direct";
    $answer_directly_text = "Répondez directement aux Avis de vos clients par email ou sms";
    $email_templates = "Thèmes d'Email";
    $email_templates_text = "Des Thèmes d'Emails adaptables aux Différents outils et Sites d'avis";
    $send_emails = "Envoyez des Emails";
    $send_emails_text = "Programmez, et envoyez des messages à vos clients pour Augmenter vos Avis";
    $send_text_messages = "Envoyez des SMS";
    $send_text_messages_text = "Contactez vos Clients sur leurs portable pour leur demander de publier des Avis ";
    $advices = "Conseils";
    $advices_text = "Des Conseils Réguliers par le biais de nos blogs ou en nous contactant par le support";
    $video_reviews = "Avis Vidéos";
    $video_reviews_text = "Demandez par sms ou Email à vos Clients de faire des Avis Vidéos !!";
    $month = "Mois";
    $months = "Mois";
    $other_services = "Autres Services";
    $other_services_below_text = "Découvrez nos Contrats sans Engagements, notre Réactivité et nos Tarifs Abordables !";
    $webmatkering_audit = "WebMatkering Audit";
    $webmatkering_audit_text = "Réalisation d'un Audit de votre PRésence internet et de tous ces Outils. Suite à cela vous sera proposé une stratégie de Développement Web";
    $online_reviews = "Avis Clients";
    $online_reviews_text = "Gestion Compléte de vos Avis Clients (Analyse, Réponse, Gestion, Promotion) afin de développer votre clientèle et la fidéliser. ";
    $social_media = "R�seaux Sociaux";
    $social_media_text = "Développez vos Communautés à partir d'Articles intéressants. Communiquez sur d'autres pages & Groupes ! Nous nous occupons de tout de A à Z";
    $seo_optimisation = "Référencement";
    $seo_optimisation_text = "Optimisation de votre Site pour le Référencement et Travail de Référencement Adwords. Améliorez votre position Google !";
    $social_advertising = "Social Advertising";
    $social_advertising_text = "Boostez vos Articles et vos pages sur les Réseaux Sociaux. Nous augmenterons considérablement les résultats
de vos pages";
    $emailing_newsletter = "Emailing @ Newsletter";
    $emailing_newsletter_text = "Réalisation de vos Campagnes d'Emailing et de vos Newsletter. Touchez vos clients et contacts comme jamais !";
    $more_informations = "Plus d'Informaions!";

}

if($_SERVER['REQUEST_URI']!="/register.php")

{

    if(isset($_SESSION['user_id']))

    {

        $sql="SELECT * FROM UserPrefer WHERE UID=" . $_SESSION['user_id'];

        $result=$conn->query($sql);

        if($result->num_rows>0)

        {

            $row=$result->fetch_assoc();

            if($row['S1']=="")

                $neg1=$negative[3];

            else

                $neg1=$row['S1'];

            if($row['S2']=="")

                $neg2=$negative[4];

            else

                $neg2=$row['S2'];

            if($row['S3']=="")

                $neg3=$negative[6];

            else

                $neg3=$row['S3'];

            if($row['S4']=="")

                $neg4=$negative[7];

            else

                $neg4=$row['S4'];

            if($row['S5']=="")

                $neg5=$negative[3];

            else

                $neg5=$row['S5'];

            if($row['S6']=="")

                $neg6=$negative[4];

            else

                $neg6=$row['S6'];

            if($row['S7']=="")

                $neg7=$negative[6];

            else

                $neg7=$row['S7'];

            if($row['S8']=="")

                $neg8=$negative[7];

            else

                $neg8=$row['S8'];

            if($row['S9']=="")

                $neg9=$negative[3];

            else

                $neg9=$row['S9'];

            if($row['S10']=="")

                $neg10=$negative[4];

            else

                $neg10=$row['S10'];

            if($row['S11']=="")

                $neg11=$negative[6];

            else

                $neg11=$row['S11'];

            if($row['S12']=="")

                $neg12=$negative[7];

            else

                $neg12=$row['S12'];

        }

        else

        {

            $neg1=$negative[3];

            $neg2=$negative[4];

            $neg3=$negative[6];

            $neg4=$negative[7];

            $neg5=$negative[3];

            $neg6=$negative[4];

            $neg7=$negative[6];

            $neg8=$negative[7];

            $neg9=$negative[3];

            $neg10=$negative[4];

            $neg11=$negative[6];

            $neg12=$negative[7];

        }

    }

}

?>
