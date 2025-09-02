# Monorepo for CSV bundle

Le code du bundle se trouve dans `/csv-bundle`, mais pour des questions de facilités à tester, j'ai tout compilé dans un monorepo avec un projet symfony prêt à le lancer.

Le bundle vient avec un README pour connaitre les différentes fonctionnalités possible.

Pour être vraiment 100% clean, l'usage du composant Serializer de Symfony aurait pu être mis place, notamment pour passer de: `CSV => RawProduct (iso CSV mais en objet) => FormattedProduct (version "formaté")`, mais un peu OverKill pour le context...
