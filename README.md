# Projet Web
# Groupe H

# Sujet : plateforme de timeline photo pour soirée et évènement

Note sur contact :

ce fichier contact permet d'envoyer un message à l'administrateur ( à son email que j'ai crée : adm.timeline@gmail.com et mdp : motdepassetimeline), 
voici qlq étapes à suivre pour afficher cette page : 
1- si vous utilisez xampp , 
  a- coller le fichier sendmail dedans 
  b- modifier votre fichier php.ini : sendmail_path="****\sendmail\sendmail.exe" , les *** c'est l'adresse ou se trouve votre sendmail.exe 
  c- modifier votre fichier (sendmail.ini)
     smtp_server=smtp.gmail.com
     smtp_port=587
     default_domain=gmail.com
     auth_username=adm.timeline@gmail.com
     auth_password=adm.timeline@gmail.com
     force_sender=adm.timeline@gmail.com
2- si vous utilisez bitnami : 
   a- coller le fichier sendmail dans le dossier Bitnami et dans apache2 , car je suis pas sur ou faut il le mettre !  
   b- modifier votre fichier php.ini : sendmail_path="****\sendmail\sendmail.exe" , les *** c'est l'adresse ou se trouve votre sendmail.exe 
   c- modifier votre fichier (sendmail.ini)
      smtp_server=smtp.gmail.com
      smtp_port=587
      default_domain=gmail.com
      auth_username=adm.timeline@gmail.com
      auth_password=adm.timeline@gmail.com
      force_sender=adm.timeline@gmail.com