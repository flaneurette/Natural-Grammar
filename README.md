# Natural-Grammar

A class to process text and auto-correct in natural grammar.

# Example:

$text = 'we were starting to ski downhill. Then, I chnage my mind. "Help!!!" I said.';
 
$run 	 = new grammar();
$grammar = $run->grammary($text);


# Results in: 

We started to ski downhill. Then, I change my mind. "Help!" I said.
