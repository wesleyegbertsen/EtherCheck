# EtherCheck
A really simple API build in PHP, that allows you to check an Etherum address' balance with the balance in Euro and Dollar with its per Ether rate.

Usage: /index.php?address=REPLACE_WITH_ADDRESS_TO_CHECK

Returns: 
```
{
  "ether": {
    "balance": Address' current balance in Ether,
    "value": {
      "euro": {
        "balance": Balance in Euro,
        "rate": Eur/Eth
      },
      "dollar": {
        "balance": Balance in USD,
        "rate": Usd/Eth
      }
    }
  }
}
```
Demo: `https://ethercheck.wesleydev.nl/api.php?address=REPLACE_WITH_ADDRESS_TO_CHECK`
