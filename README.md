# Natural-Grammar

A class to process text and auto-correct in natural grammar.

# Example text

We were starting to ski downhill. Then, I chnage my mind. "Help!!!" I said.

# Example code:
       $run     = new grammar();
       $text    = 'we were starting to ski downhill. Then, I chnage my mind. "Help!!!" I said.';
       $grammar = $run->grammary($text);
       
       echo $grammar;


# Results in: 

We started to ski downhill. Then, I change my mind. "Help!" I said.
