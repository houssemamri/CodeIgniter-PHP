<?php
if(!isset($_SESSION['language']))
  $lang = 'fr';
else
  $lang=$_SESSION['language'];
//$lang = "fr";
if(strcmp($lang,'en')==0)
{
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
  $welcomeMsg="Choose from any of the Menu Item above or checkout the tutorial.";
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

  $ansbox="AnsBox-eng.png";

  $sex1="Man";
  $sex2="Woman";
  $sex3="Unisex";
  $positive=array("Greeting","Thanks for choosing Us","Was it a nice time ?","Thanks for the Review","Preferred Part","Importance of Reviews","Follow us Online/Closing Sentence","Polite Ending");
  $negative=array("Greeting","Thanks for choosing Us","What happend?","Situation 1","Situation 2","Preferred Part","Situation 3","Situation 4","Explanations","Closing Sentence","Polite Ending");
  $simple=array("Greeting","Thank you for Coming","Thanks for the Review","Preferred Part","Closing Sentence","Polite Ending");

  //$generate="Générer";
  $generateHeader="Answers to Reviews";
  $generateBox="Press Generate Button to get your result";

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
  $uploadWelcome="Choose from any of the Options to upload your parts for any type of Answers.";
  $uploadTitle="Upload";
  $uploadMsg="Upload your own parts to the Possible Answers";
  $uploadBtn="Upload";

  /*Update Section*/

  $updateWelcome="Choose from any of the Options to Update your parts for any possible answer present below.";
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

  $contactInfo="Give us a call or send us an Email, we try to answer all enquiries within 24 hours on business days. <br /><br /> We are open from 9am 6pm week days";

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

  $checkEmail="Please check your mail for further instructions.";
  $changePassword="Click here to change your password:";

  $successChange="Successfully changed password";
  $updateDetail="Update Details";
  $changePwd="Change Password";
$googleacc_access = "Google Account Access";
$client_idd ="Client ID";
$client_secrett = "Client Secret";
$retrievingIdToken="Retrieving An Id Token";
$connectme ="Connect Me";
  /*User Profile*/

  $profile="Profile";
  $profileWelcome="Welcome to your user profile";
  $editProfile="Edit Profile";

  $editLinks="Edit Links";
  $saveLinks="Save Links";
  $saveBtn="Save Links";
  $newPwd="New Password";
  $uploadPic="Upload Profile Picture";

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

}
else if(strcmp($lang,'spa')==0)
{
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

  $ans1="Respuesta positiva";
  $ans2="Respuesta Negativa";
  $ans3="Respuesta Positiva y simple";

  $ansbox="AnsBox-spa.png";

  $sex1="Hombre";
  $sex2="Mujer";
  $sex3="Unisex";
  $positive=array("Saludo","Gracias por Elegir nos","Como fue ?","Gracias por esta Revista","Parte Preferida","Importancia de las Revistas","Seguir nos (internet) /Otra phrase de conclusion","Fórmula de cortesía");
  $negative=array("Saludo","Gracias por Elegir nos","Que pasa?","Situación 1","Situación 2","Parte Preferida","Situación 3","Situación 4","Explicaciones","Phrase de conclusion","Fórmula de cortesía");
  $simple=array("Saludo","Gracias por tu Visita","Gracias por esta Revista","Parte Preferida","Phrase de conclusion","Fórmula de cortesía");

  //$generate="Générer";
  $generateHeader="Respuestas a tus Revistas";
  $generateBox="Apretar el Botón Generar para tener sus Resultados";

  $sendMail="send-spa.png";

  $save="Salvar";

  /*Menu*/

  $home="Pàgina Principal";
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
  $logout="Cerrar sesión";
  $login="Conectarse";
  $changelang ="Idiomas";

  /*Upload Section*/
  $uploadWelcome="Escoger una de las Opciones para añadir sus partes a cada tipo de respuestas.";
  $uploadTitle="Cargar";
  $uploadMsg="Cargar tu propias partes a este base de datos";
  $uploadBtn="Cargar";

  /*Update Section*/

  $updateWelcome="Escoger una de las Opciones para modificar sus partes y eso para cada tipo de respuestas.";
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
  $adminHome="Pàgina Principal";
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
  $enterEmail="Dirección de Email";
  $sendEmail="Enviar el Email";
  $loginBtn="Conectarse";

  $checkEmail="Gracias por Verificar su Email para más instrucciones.";
  $changePassword="Hacer clic aquí para modificar la contraseña.";

  $successChange="Contraseña Cambiada";
   $updateDetail="Detalles de actualización";
  $changePwd="Cambiar Contraseña";
  $googleacc_access = "Acceso a la cuenta de Google";
  $client_idd ="Identificación del cliente";
  $client_secrett = "Secreto del cliente";
  $retrievingIdToken="Recuperar un token de identificación";
  $connectme ="Conectame";

  /*User Profile*/

  $profile="Perfil";
  $profileWelcome="Puedes elegir una de tus empresas";
  $editProfile="Modificar tu Perfil";
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
  $sendEmails = "Envoi d’emails";
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
  $SMTPmsg="Por Favor, Instalé tu informacion SMTP";
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
  $loginFail = "<strong>Attention!</strong> Merci D’Entrer Le Mot De Passe Correct.";
  $addNewCompany = "Add Company";
  $company = "Company";
  $updateDetails = "Cambiar Perfil";
  

  /* Password forget details */
  $checkEmailForgot = "Tienes que verificar tus email i Seguir l’as instrucciones que vas à encontrar dentro.";
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
}
else
{
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
  $msgUsr="Rien n’est plus important que la personnalisation. Toutes nos réponses sont uniques et modifiables";
  $sec1="Hôtel";
  $sec2="Restaurant";
  $sec3="Loisirs";
  $sec4="Culture";
  $sec5="Produits";
  $sec6="Services";

  /*Language Page*/
  $generateMsg="Générez des réponses à vos commentaires dans les langues disponibles. Modifiez les ou écrivez les ci-dessous.";
  $lang1="Français";
  $lang2="Anglais";
  $lang3="Espagnol";

  $ans1="Réponse Avis Positif";
  $ans2="Réponse Avis Négatif";
  $ans3="Réponse Positive Simple";

  $ansbox="AnsBox-fr.png";

  $sex1="Homme";
  $sex2="Femme";
  $sex3="Unisexe";
  $positive=array("Salutation","Merci du Choix","Bien passé?","Merci pour l’avis","Partie Préférée","Importance des Avis","Suivi Internet ou Autre Cloture","Formule de politesse");
  $negative=array("Salutation","Merci du Choix","Que s'est il passé?","Situation 1","Situation 2","Partie Préférée","Situation 3","Situation 4","Explication","Cloture","Formule de politesse");
  $simple=array("Salutation","Merci d'être venu","Merci pour l’avis","Partie Préférée","Cloture","Formule de politesse");

  //$generate="Générer";
  $generateHeader="Réponses aux Avis";
  $generateBox="Appuyer sur le Bouton Générer pour avoir vos Résultats";

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

  $updateWelcome="Choisir une des Options pour modifier vos parties et cela pour chacune des possibilités de réponse.";
  $updateTitle="Modification";
  $updateMsg="Modifier les différentes Parties des différents types de Réponses cidessous.";
  $select="Séléctionner";
  $updateBtn="Charger";

  /*Support Section*/

  $supportTitle="Support";
  $supportMsg="Vous avez des Questions ou Avez besoin d’Aide ? Envoyez nous un message !";
  $yourName="Votre Nom";
  $yourEmail="Votre Adresse Email";
  $yourMessage="Votre Message";
  $sendSupport="Envoyer Question";

  $contactInfo="Appelez nous ou Passez nous voir quand bon vous semble. Nous répondrons à vos questions en moins de 24h. <br /><br /> Nous sommes ouverts de 9h à 18h en semaine";

  /*Admin section*/

  $adminWelcome="Bienvenue sur le Panel d’Administration";
  $adminHome="Accueil";
  $adminRegister="Ajout d’Utilisateur";
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
  $registerBtn="S’Enregistrer";
  $registerBack="Retour";

  /*Login Page*/

  $login="Se Connecter";
  $loginEmail="Email";
  $loginPassword="Mot de Passe";
  $loginForgot="Mot de Passe Oublié";
  $enterEmail="Entrer Adresse Email";
  $sendEmail="Envoyer l’Email";
  $loginBtn="Se Connecter";

  $checkEmail="Merci de Vérifier votre Email pour plus d’instructions.";
  $changePassword="Cliquer ici pour modifier le mot de passe.";

  $successChange="Mot de Passe changé avec succès";
   $updateDetail="Détails de la mise à jour";
  $changePwd="Changer Mot de Passe";
  $googleacc_access = "Accès au compte Google";
  $client_idd ="identité du client";
  $client_secrett = "Secret du client";
  $retrievingIdToken="Récupération d'un jeton d'identification";
  $connectme ="Me connecter";

  /*User Profile*/

  $profile="Profil";
  $profileWelcome="Bienvenue sur votre Profil";
  $editProfile="Modifier le profil";
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
  $item="Élément";
  $addbtn="Ajouter";
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
  $userName="Nom d’Utilisateur";
  $pwd="Mot de Passe";
  $internet="Services Internet";
  $legal="MENTIONS LÉGALES";
  $manageEmailList="Gérer Listes d’Emails";
  $sendEmails = "Envoi d’emails";
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
  $uploadMultiEmail="Charger une Liste d’Email";
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
  $Situation = "Siutation";
  $saveSMTP = "Sauvegarder Configuration";
  $updateEmail = "Modification Email";
  $loginFail = "<strong>Attention!</strong> Merci D’Entrer Le Mot De Passe Correct.";
  $addNewCompany = "Ajout Enterprise";
  $company = "Enterprise";
  $updateDetails = "Enregistrer Modifications";

  /* Password forget details */
  $checkEmailForgot = "Merci de vérifier vos e-mails et d’y suivre les instructions complémentaires.";
  $wrongEmail = "Merci d’utiliser une adresse email correcte.";
  $passwordEmail = "Merci de changer votre mot de passe en utilisant le lien suivant.";
  $invalidEmail = "Merci d’insérer une adresse e-mail valide.";
  $enterProper = "Please enter a proper password.";
  $passwordChangeSuccess = "Votre mot de passe a été changé avec succès!";
  $passwordTryAgain = "Merci de réessayer.";

  $activity = "activity-fr.png";

  $readProfile = "Lecture";
  $answerProfile = "Réponse";

  $successAdd = "Nouveau Compte d’entreprise Créé";


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
