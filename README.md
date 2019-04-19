# Natural-Grammar

A class to process text and auto–justifiable in natural grammar following the Chicago style guide. It auto–corrects: Punctuation, anglicized words, past tense, indivis–ible words, invalid conjunctions, comparisons, spelling mistakes, overuse of contractions, exaggerations, hyperbole. A thesaurus is also used to beautify certain words, without overdoing it. The class also compares hundreds of natural grammar fragments which I extracted and constructed from reading and editing many (news) articles and books. Any replacements made are randomized through a thesaurus, in such a way, that the text flows natural instead of being over corrected. It does some minor auto–corrections on justifiable spelling; it only replaces that which it can safely replace, leaving room for copy editors to gloss over the text without the strain of minor mistakes.



# License
Copyright 2019 Alexandra van den Heetkamp.
This class is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published      by the Free Software Foundation, either version 3 of the License, or any later version. Be sure to include the attached license when you distribute the software.         

# Example text

We were starting to ski downhill in my 1000$ camoflage suit, like I did a million times before. 
Then, I chnaged my mind. 
"Help!!!" I said. 
Jane heard me. 
she said: "What's wrong"? 
Oooooooouch!!!

# Example code:
       $run     = new grammar();
       $text    = 'We were starting to ski downhill in my 1000$ camoflage suit, like I did a million times before. Then, I chnaged my mind. "Help!!!" I said. Jane heard me. she said: "What's wrong"? Oooooooouch!!!';
       $grammar = $run->grammary($text);
       
       echo $grammar;


# Results in corrected text: 

We started to ski downhill in my $1000 camouflage suit, like I did many times before. 
Then, I changed my mind. 
"Help!" I said. 
Jane heard me. 
she said, "What's wrong?" 
Oouch!
