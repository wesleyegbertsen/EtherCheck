# EtherCheck
A really simple API build in PHP, that allows you to check an Etherum address' balance with the balance in Euro and Dollar with its per Ether rate.

Usage: /index.php?address=REPLACE_WITH_ADDRESS_TO_CHECK

Returns: 
```
{
  "ether": {
    "balance": Address' current balance,
    "value": {
      "euro": {
        "balance": Balance in Euro,
        "rate": Eth/Eur
      },
      "dollar": {
        "balance": Balance in USD,
        "rate": Eth/Usd
      }
    }
  }
}
```
