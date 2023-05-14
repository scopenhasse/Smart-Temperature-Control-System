# Installation de l'OS Raspberry Pi

## Prérequis

- Un ordinateur sous Linux
- Une carte microSD de 8 Go minimum
- L'image de l'OS Raspberry Pi téléchargée au format .zip

## Étapes

1. Insérez la carte microSD dans votre ordinateur
2. Ouvrez un terminal et exécutez la commande `lsblk` pour lister les périphériques de stockage connectés à votre ordinateur. Notez le nom de périphérique de votre carte microSD, par exemple `/dev/sdb`.
3. Exécutez la commande `unzip 2021-10-30-raspios-bullseye-armhf-lite.zip` pour extraire l'image de l'OS téléchargée.
4. Exécutez la commande `sudo dd bs=4M if=2021-10-30-raspios-bullseye-armhf-lite.img of=/dev/sdb conv=fsync` pour écrire l'image de l'OS sur votre carte microSD. Assurez-vous de remplacer `/dev/sdb` par le nom de périphérique de votre carte microSD. Cette étape peut prendre plusieurs minutes.
5. Une fois l'écriture terminée, exécutez la commande `sudo eject /dev/sdb` pour démonter la carte microSD en toute sécurité.
6. Retirez la carte microSD de votre ordinateur et insérez-la dans votre Raspberry Pi.

Vous êtes maintenant prêt à utiliser votre Raspberry Pi avec l'OS installé !
