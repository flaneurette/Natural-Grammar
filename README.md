# Natural-Grammar

A class to process text and auto-correct in natural grammar. It auto-corrects: Punctuation, angelicized words, past tense, indivis-
ible words, invalid comparisions, contractions, exagerations and follows the Chicago style guide. A brief thesaurus is also used to beautify certain words, where applicable. The class contains hundreds of fragments which I extracted from reading and editing news articles and books. 

# License
Copyright 2019 Alexandra van den Heetkamp.
This class is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published      by the Free Software Foundation, either version 3 of the License, or any later version. Be sure to include the attached license when you distribute the software.         

# Example text

We were starting to ski downhill in my camoflage suit, like I did a million times before. Then, I chnage my mind. "Help!!!" I said. Jane heard me. she said: "What's wrong"?

# Example code:
       $run     = new grammar();
       $text    = 'We were starting to ski downhill in my camoflage suit, like I did a million times before. Then, I chnage my mind. "Help!!!" I said. Jane heard me. she said: "What's wrong"?';
       $grammar = $run->grammary($text);
       
       echo $grammar;


# Results in corrected text: 

We started to ski downhill in my camouflage suit, like I did many times before. Then, I change my mind. "Help!" I said. Jane heard me. she said, "What's wrong?"
