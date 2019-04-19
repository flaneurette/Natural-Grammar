# Natural-Grammar

A class to process text and auto–correct natural grammar following the Chicago style guide. It auto–corrects:

       Anglicized words
       Character repeat
       Capitals
       Dashes
       Exaggerations
       Hyperbole
       Indivisible words
       Invalid conjunctions
       Invalid comparisons
       Spelling mistakes
       Slang
       Overuse of contractions
       Oxford comma (replacing it)
       Punctuation
       Past tense correction

A thesaurus is also used to beautify certain words without overdoing it. The class also compares hundreds of natural grammar fragments which I extracted and constructed from reading and editing many (news) articles and books. Any replacements made are randomized through a thesaurus, in such a way, that the text flows natural instead of being over corrected. It does some minor auto–corrections on justifiable spelling; it only replaces that which it can safely replace, leaving room for copy editors to gloss over the text without the strain of obvious mistakes.

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

# License
Copyright 2019 Alexandra van den Heetkamp.
This class is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published      by the Free Software Foundation, either version 3 of the License, or any later version. Be sure to include the attached license when you distribute the software.   

Friendly request:

Please do not use this class as an excuse for careless writing. It is a useful tool to find something you missed and ease the work of copy editors and proofreaders (which is extremely hard work.) The best solution is to start writing slowly and thoughtfully, so that correction has a minimal role.
