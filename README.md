# Natural-Grammar

A class to process text and auto-correct in natural grammar, which follows the Chicago style code. The class also contains hundreds of fragments that I extracted from reading and editing news articles and books. It also has a small thesaurus of most used words.

# Example text

We were starting to ski downhill in my camoflage suit, like I did a million times before. Then, I chnage my mind. "Help!!!" I said. Jane heard me. she said: "What's wrong"?

# Example code:
       $run     = new grammar();
       $text    = 'We were starting to ski downhill in my camoflage suit, like I did a million times before. Then, I chnage my mind. "Help!!!" I said. Jane heard me. she said: "What's wrong"?';
       $grammar = $run->grammary($text);
       
       echo $grammar;


# Results in corrected text: 

We started to ski downhill in my camouflage suit, like I did many times before. Then, I change my mind. "Help!" I said. Jane heard me. she said, "What's wrong?"
