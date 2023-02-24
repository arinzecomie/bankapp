<?php
$bank_list = array("Shanghai Pudong Development Bank ", "Shinhan Bank Korea", "Standard Chartered Bank", "Vietcom Bank", "Ping An bank Co. LTD", "Deutsche Bank", "Ping An bank Co. LTD", "Abu Dhabi International Bank Inc.", "Abbey National Treasury Services Ltd", "Enterprise Bank	Los Angeles", " United Bank	Boca Raton,Fl", "Abbey National Securities Inc.", "Aci Capital Group, Llc", "Aegon Usa Investment Management, Llc", "Agricultural Bank Of China", "Ally Financial Inc", "American First National Bank", "Apollo Bank	Miami,Fl", "Ares Management Llc", "Atlantic Central Bankers Bank", "Bank Hapoalim B.M", "Bank Of Hangzhou Co., Ltd");


$acc_name = array("Van Leeuwen Company", " Carbon Steel Pipes Company", "Mark Jedidiah Wong", "Pham lee Dinh", "Niedersachsen steel and metal", "China Sait-Co LTD", "A R T International Inc.", "724 Solutions Inc.", "Edward Jason", "Eric Shirley", "Converium Holding AG", "Stephen Larry", "Scot Nicole", "Frank Denis", "Cream Minerals Ltd.", "Energy Power Systems Ltd", "Aaron Jose", "Nathan Kyle", "Harold Walter", "Sean Noah", "Bryan Billy", "Alan Juan");


$swift_code = array("ICBKCNBJGDG", "094GUH11", "DBSSSGSGXXX", "CVZBYVNPX", "SZCBCNBSDGNA", "094GUH11", "SZCBCNBSDGNA", "BTSIUS44BTS", "BOFAUS3DSG3", "AGIGUS33MKT", "BBVAUS33GCI", "CRESUS33LNO", "BEASCNSHCCC", "HZCBCN2HSHB", "JZCBCNBJSYN", "NOSCCN22SHI", "RZCBCNBDQD1", "BOSHCNSHNJA", "CRESUS33FXO", "CSFBUS33OCE", "POALUS33MIA", "WY5HLDU6GK9");

echo array_rand($bank_list); echo "<hr>";
echo rand(1, 20); echo "<hr>";
echo count($bank_list);
echo count($acc_name);
echo count($swift_code);
?>