# rsa
Usage examples of symmetric and asymmetric cryptos, hashes in phpseclib (PHP Security Library).

For hashing passwords do not use md5, unsalted sha1. Use bcrypt or pbkdf2.

Sha1 should not be used as MAC (Message Authentication Code), use sha2 (sha-256 or sha-512) instead.
