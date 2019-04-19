<?php

###########################################################################
##                                                                       ##
##  Copyright 2019 Alexandra van den Heetkamp.                           ##
##                                                                       ##
##  This class is free software: you can redistribute it and/or modify it##
##  under the terms of the GNU General Public License as published       ##
##  by the Free Software Foundation, either version 3 of the             ##
##  License, or any later version.                                       ##
##                                                                       ##
##  This class is distributed in the hope that it will be useful, but    ##
##  WITHOUT ANY WARRANTY; without even the implied warranty of           ##
##  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the        ##
##  GNU General Public License for more details.                         ##
##  <http://www.gnu.org/licenses/>.                                      ##
##                                                                       ##
###########################################################################

class grammar {

	public $consonants = ['b','c','d','f','g','h','j','k','l','m','n','p','q','r','s','t','v','x','y','z'];
	public $vowels	   = ['a', 'e', 'i', 'o', 'u'];
	
	public function __construct($params = array()) 
	{ 
		$this->init($params);
	}
	
	public function __destruct()
	{
		$this->grammar	  = [];
		$this->misspelled = [];
		$this->thesaurus  = [];
	}
	
	/**
	* Initializes object.
	* @param array $params
	* @throws Exception
	*/
	
	 public function init($params)
	 {
		try {
			isset($params['var'])  ? $this->var  = $params['var'] : false; 
			} catch(Exception $e) {
			$this->message('Problem initializing:'.$e->getMessage());
		}
	 }
	
	/**
	* shows a message to the user.
	* @param string
	* @return string
	*/
	
	public function message($string) 
	{
		return $string;
	}	

	/**
	* name grammary function
	* @param string
	* @return string
	*/
	
	public function grammary($text) {

		$grammar 	= $this->grammar;
		$misspelled 	= $this->misspelled;
		$thesaurus	= $this->thesaurus;

		for($i = 0; $i < count($grammar); $i++) { 
			$entry = $grammar[$i][1];
			$number = substr_count($text,$grammar[$i][0][0]);
			for($j = 0; $j < $number; $j++) {
				$text = preg_replace('/'.$grammar[$i][0][0].'/',$entry[mt_rand(0,count($entry)-1)],$text);
			}
		}
		
		for($l = 0; $l < count($misspelled); $l++) { 
			for($k = 0; $k < count($misspelled[$l][1]); $k++) { 
				$number = substr_count($text,$misspelled[$l][1][$k]);
				if($number > 0) { 
					for($j = 0; $j < $number; $j++) {
						$text = preg_replace('/\s'.$misspelled[$l][1][$k].'/i',' '.$misspelled[$l][0][0],$text);
					}
				}
			}
		}
		
		for($i = 0; $i < count($thesaurus); $i++) { 
			$entry = $thesaurus[$i][1];
			$number = substr_count($text,$thesaurus[$i][0][0]);
			for($j = 0; $j < $number; $j++) {
				$text = preg_replace('/\s'.$thesaurus[$i][0][0].'\s/i',' '.$entry[mt_rand(0,count($entry)-1)].' ',$text);
			}
		}		
		
	   $text = $this->punctuation($text);
       	return $text;
	}
	
	/**
	* name helper function
	* @param string
	* @return string
	*/
	
	public function pastTenseHelper($text){
		
		$textsplit 	= explode(PHP_EOL,$text);
		$textnew 	= [];
		
		for($t = 0; $t < count($textsplit); $t++) {

			preg_match("/(she|he|we|they|I)\s+(were|was)\s+(\w+)/i",$text,$matches);
			if(substr($matches[3],-3) == 'ing') {
				// run past tense check.
				$rewrite = $this->pastTense($matches[3]);
				$new = $matches[2] . $rewrite;
				array_push($textnew,str_replace($matches[0],$new,$text));
			}
		}
		if(count($textnew) >1) {
			return implode(PHP_EOL,$textnew);
			} else {
			return $text;
		}
	}
	
	/**
	* name past-tense function
	* @param string
	* @return string
	*/
	public function pastTense($verb){
	
		$output = $verb;
		$oldverb = $verb;
		
			if(substr($verb,-3) == 'ing') {
					$verb = str_replace('ing','',$verb);
					$len = strlen($verb);
					if($len > 1) { 
						if(substr($verb,-1)=='e'){
						$output = $verb . "d";	
						} else if(in_array(substr($verb,-2,1),$this->consonants) 
							&& substr($verb,-1) != 'y' 
							&& substr($verb,-1) != 't'){
							$output = $verb . "ied";
						} else if(($len > 2) && !in_array(substr($verb,-3,1),$vowels)
							&& in_array(substr($verb,-2,1),$this->vowels)
							&& in_array(substr($verb,-1),$this->consonants)
							&& substr($verb,-1) != 'w' 
							&& substr($verb,-1) != 'y') {
							$output = $verb . "ed";
							} else {
							$output = $verb . "ed";
						}
					} else {
						$output = $oldverb;
					}
			}
		return $output;
	}	
	
	/**
	* name punctuation
	* @param string
	* @return string
	*/
	public function punctuation($text) {
	
		$find 	 = ['’' ,'’' ,'’' ,'‛' ,'´' ,'′','.!','”!','"!','"?','-'];
		$replace = ['\'','\'','\'','\'','\'','\'','!','!”','!"','?"','–'];

		$text = str_replace($find,$replace,$text);
		
		// Limit exclamation points (!) and only on end of paragraph.
		$text = preg_replace('/!{2,}/msi','!',$text);
		// Only use a colon ; if you want to set a list of items
		
		// Dollar sign placement
		$text =  preg_replace('/\s+([0-9]*)\s*\$/msi', ' $\1', $text);
		
		// Use a comma when a dialogue tag follows a quote.
		$text =  preg_replace('/\.\"\s*(she|he|they|I)/msi','," \1',$text);
		
		// Add a comma to introduce a quote, or text.
		$text =  preg_replace('/(she|he|they|I)\s+(said)(\s*|:|;)\s*\"/msi','\1 \2, "',$text);
		
		// No comma is required with conjunctions
		$text =  preg_replace('/that,\s*\"(there|this|the)/msi','that "\1',$text);
		
		$text =  preg_replace('/whether,\s*\"(there|this|the)/msi','whether "\1',$text);
		// Interrogation point: (?)
		// nons should always be seperated by a single hyphen
		$text =  preg_replace('/(\s+non\s+)/msi',' non-',$text);
		
		// Remove repeating letters.
		$text =  preg_replace('/(.)\1{3,}/msi','$1',$text);

		// Only about 12 words in the English language have this fragment, in most cases it is a mistake.
		$find_typo   = ['uhgt',' akn','meing','chnag','chanche'];
		$repl_typo   = ['ught',' ack','ming','chang','chance'];
		$text = str_replace($find_typo,$repl_typo,$text);
		
		$text = $this->pastTenseHelper($text);
		
		return $this->tabs($text);
	}
	
	/**
	* name tabs, idents paragraphs
	* @param string
	* @return string
	*/
	
	public function tabs($text) {
		$newtext = '';
		$number = explode(PHP_EOL,$text);
		for($i=0;$i<count($number);$i++) {
			if(strstr($number[$i],'“') || strstr($number[$i],'"')) {			
			$newtext .= "\t".$number[$i];
			} else {
			$newtext .= $number[$i];
			}
		}
	return $newtext;
	}

	/**
	* Arrays
	* @var array
	*/				
	
	public $grammar = [

			[['if I was'],['if I were']],
			[['literally'],['practically','essentially', 'metaphorically']],
			[['mainly'],['primarily', 'principally', 'essentially', 'first and foremost']],
			[['chiefly'],['primarily', 'principally', 'essentially', 'first and foremost']],
			[['I found out'],['I discovered', 'I determined', 'I observed']],
			// Contractions.
			[['it got'],['it has']],
			[['it isn\'t'],['it is not']],
			[['let\'s'],['let us']],
			[['That\'s'],['That is']],	
			[['that\'s'],['that is']],
			[['Don\'t'],['do not']],
			[['don\'t'],['do not']],		
			// Useful contracttions 
			// too much 'ing' past tense:
			[['We were starting to'],['We started to']],
			[['we were starting to'],['we started to']],
			// We only should use she said when a comma follows: "she said,"
			[[', she said.'],[', said she.']],
			[['" she said.'],['" said she.']],
			[[', she cried.'],[', cried the girl.']],
			[['" she cried.'],['" cried the girl.']],
			[[', he said.'],[', said he.']],
			[['" he said.'],['" said he.']],
			[[', he cried.'],[', cried the boy.']],
			[['" he cried.'],['" cried the boy.']],
			// Found a period, so it's conclusive (?)
			[['" he said.'],['" he said at last.','" he said finally.','" he said without hesitation.','" he said conclusively.','" he said affirmingly.']],
			[['" she said.'],['" she said at last.','" she said finally.','" she said without hesitation.','" she said conclusively.','" she said affirmingly.']],
			[[', she replied.'],[', replied she.']],
			[['" she replied.'],['" replied she.']],
			[[', she cried.'],[', cried the girl.']],
			[['" she cried.'],['" cried the girl.']],
			[[', he replied.'],[', replied he.']],
			[['" he replied.'],['" replied he.']],
			[[', he cried.'],[', cried the boy.']],
			[['" he cried.'],['" cried the boy.']],			
			[['" he replied.'],['" he replied at last.','" he replied finally.','" he replied without hesitation.','" he replied conclusively.','" he replied affirmingly.']],
			[['" she replied.'],['" she replied at last.','" she replied finally.','" she replied without hesitation.','" she replied conclusively.','" she replied affirmingly.']],
			// Exclamation points indicate the raising of voice.
			[['!" he said.'],['!" he exclaimed.','!" he uttered.','!" he asserted.','!" he voiced.']],
			[['!" she said.'],['!" she exclaimed.','!" she uttered.','!" she asserted.','!" she voiced.']],	
			[['Alas.'],['Alas!']],
			[['Alas,'],['Alas!']],
			// Dashed / emphasis
			[['? Oh!'],['?—Oh!']],
			[['Then he said,'],['Then he said,—']],
			[['Then she said,'],['Then she said,—']],
			[[', saying, "'],[', saying,—"']],			
			[['Saying, "'],[' Saying,—"']],			 
			[[', saying: , saying,—"']],			
			[['Saying: "'],['Saying,—"']],				 
			// It's vs Its
			[['Its all'],['It\'s all','It is all']],
			[['its all'],['it\'s all','it is all']],
			[['who its'],['who it\'s','who it is']],
			[['into it\'s'],['into its']],
			[['lost it\'s'],['lost its']],
			[['it\s your\'s'],['it is yours']],
			[['it\s your'],['it is your']],
			[['all your\'s'],['all yours']],
			// \he\/ catches both: he and she.
			[['he is allright'],['he is all right','he is fine']],
			[['all of who'],['all of whom']],
			[['most of who'],['most of whom']],
			[['whom she'],['who she']],
			[['whom he'],['who he']],
			[['whom just'],['who just']],
			[['can I'],['may I']],
			[['and I to'],['and me to']],
			[['and I.'],['and me.']],
			[['bored by'],['bored with', 'bored of']],
			// As, since, because?
			[['persons'],['people']],
			[['he complemented her'],['he complimented her']],
			[['he complemented him'],['he complimented him']],
			[['he complemented them'],['he complimented them']],
			[['asking for trouble'],['problematic', 'ambiguous', 'dubious', 'precarious', 'questionable']],
			// Too much butting...(where did it start?)
			[['but this'],['although this', 'however, this', 'nevertheless this', 'on the other hand, this', 'though this', 'yet this']],
			[['but that'],['although, that', 'however, that', 'nevertheless, that', 'on the other hand, that', 'though, that', 'yet, that']],
			[['but what'],['although what', 'however what', 'though what']],
			[['but a'],['although a', 'however a', 'though a']],
			[['but a'],['although a', 'however a', 'though a']],
			[['but s'],['although s', 'however s', 'though s']],
			[['but c'],['although c', 'however c', 'though c']],
			[['But,'],['Although,','However,','Nevertheless,','Though,','Yet,']],
			[['But otherwise'],['Although','However','Nevertheless','Though','Yet']],
			[['but otherwise'],['although','however','nevertheless','though','yet']],			
			[['Still,'],['However,', 'Nevertheless,', 'On the other hand,', 'Though,', 'Yet,']],
			[['maybe '],['perhaps ', 'as it may be ', 'conceivably ']],
			[['correct '],['appropriate ', 'certain ', 'consistent ', 'genuine ', 'justifiable ', 'logical ', 'natural ', 'reasonable ', 'reliable ','well-founded ']],
			[['blogging'],['writing', 'discussing']],
			[['whatever'],['whatsoever']],
			[['I thought'],['I contemplated', 'I deduced', 'I anticipated', 'I hoped', 'I speculated', 'I reflected', 'I concluded']],
			[['I posted'],['I wrote', 'I published']],
			[['I talked about'],['I discussed', 'I wrote about']],
			[['that uses'],['that utilizes', 'that makes use of', 'that services']],
			[['and myself'],['and me']],
			[['myself included'],['and me']], 
			// Regex suggestion: I did (.*) myself, should be: I did (.*)
			// Inaudible H.
			[['an hour'],['a hour']],
			[['an honour'],['a honour']],
			[['an honest'],['a honest']],
			[['an heir'],['a heir']],
			[['an historic'],['a historic']],
			[['an half'],['a half']],
			[['an horse'],['a horse']],
			// neither X nor, instead of:  neither X,Y,Z nor 
			// He/I (.*) adverse should be: He/I (.*) averse
			// spelling.
			[['of coarse'],['of course','certainly']],
			[['simple'],['easy']],
			[['full proof'],['foolproof']],
			[['fullproof'],['foolproof']],
            		// Further contractions
           		[['I\'ve'],['I have']],
           		[['I\'ll'],['I will']],
			[['I\'ve never'],['I have never']], 
            		[['They\'ve'],['They have']],
			[['Yes, I'],['Indeed, I','I']], 
			[['truly'],['absolutely','actually','definitely','genuinely','rightly']],
			[['Lots of people'],['A lot of people','Many']],
			[['Lot\'s of people'],['A lot of people','Many']],	
			[['lots of people'],['a lot of people','many']],
			[['lot\'s of people'],['a lot of people','many']],	
			[['It sounds like a good idea'],['It seems like a good idea']],	
			[['it sounds like a good idea'],['it seems like a good idea']],
			[['be sure to use'],['make sure to use']],
			[['it\'s a real pain'],['it\'s a problem']],
			[['a nice idea'],['a good idea']],
			[['Granted,'],['Indeed,']],
			[['granted,'],['indeed,']],	
			[['The most important thing'],['An important thing']],	
			[['the most important thing'],['an important thing']],
 			[['I still like to'],['I like to']],	
			[['a lot of'],['numerous', 'abounding', 'bounteous', 'quite a few', 'many', 'myriad', 'diverse', 'a great number']],
			[['currently'],['presently', 'at present', 'forthwith', 'right now']],
			[['a couple of'],['numerous', 'a few', 'some']],
			[['they have build'],['they have built']],
			[['they build'],['they built']],
			[['he has build'],['he has have built']],
			[['I have build'],['I have built']],
			[['I build'],['I built']],
			[['will built '],['will build']],
			[['build up'],['built up']],
			[['Alright, so I'],['I']],
			[['Well, I '],['I']],
			[['\'Cause'],['Because']],
			[['\'cause'],['because']],	
			[['it lacks'],['it falls short', 'is is insufficient', 'it wants']],
			[['isn\'t up to me'],['is not up to me', 'is not my responsibility']],
			[['unarguable'],['inarguable', 'compelling', 'ascertained',  'conclusive', 'demonstrable', 'establishable']],
			[['inarguable'],['compelling', 'ascertained', 'authoritative', 'conclusive', 'demonstrable', 'establishable']],
			[['am glad'],['am contented', 'am pleased', 'am gratified']],
			[['do you have an opinion'],['what is your opinion', 'what is your view']],
			[['most often'],['routinely', 'regularly']],
			[['nevermind'],['never mind']],
			[['are due to'],['are caused by', 'are precipitated by']],
			[['allmost all'],['nearly all', 'the greater part']],
			[['sometimes'],['frequently', 'occasionally', 'at times', 'every so often']],
			[['somehow along the road'],['somehow']],
			[['I hear you,'],['I acknowledge your arguments,']],
			[['so what is'],['then what is', 'what is']],
			[['I am not sure'],['I am uncertain']],
			[['when you don\'t'],['when one doesn\'t']],
			[['then how can you'],['then how can one']],
			[['as you can'],['as one can']],
			[['noticed'],['observed', 'witnessed', 'discovered', 'perceived']],
			[['stuff'],['thing']],
			[['because that'],['as that']],
			[['The first thing we could try'],['One thing we could do']],
			[['is to try to'],['is to']],
			[['as we know,'],['it is known,']], 
			[['a very interesting'],['a interesting']], 
			[['I got a couple of questions'],['I received a few questions']],	
			[['ontrary what many people believe'],['ontrary to popular belief']],	
			[['than we are used to'],['than we are acustomed to','than we are conditioned to']],
			[['jealous'],['invidious', 'jaundiced', 'apprehensive', 'envious', 'intolerant', 'possessive', 'protective', 'begrudging', 'covetous', 'doubting']],
            		[['amazing'],['incredible', 'fabulous', 'wonderful', 'fantastic', 'astonishing', 'astounding']],
            		[['her anger'],['her rage', 'her fury', 'her arousal', 'her nettled', 'her exasperation', 'her maddening']],
            		[['his anger'],['his rage', 'his fury', 'his arousal', 'his nettled', 'his exasperation', 'his maddening']],
            		[['my anger'],['my rage', 'my fury', 'my arousal', 'my nettled', 'my exasperation', 'my maddening']],
			// Catches both: i-t, tha-t and many other words ending on a t.
			[['t sounds crazy'],['t sounds preposterous','t sounds irrational', 't sounds unreasonable']],
			[['famous'],['well-known', 'renowned', 'celebrated', 'famed', 'eminent', 'illustrious', 'distinguished']],
			[['delicious'],['savory', 'delectable', 'appetizing', 'luscious', 'scrumptious', 'palatable', 'delightful', 'enjoyable', 'toothsome', 'exquisite']],
			[['scared of'],['afraid of', 'frightened of', 'alarmed of', 'terrified of', 'fearful of', 'unnerved by','disquieted by']],
			[['feel happy'],['feel pleased', 'feel contented', 'feel satisfied', 'feel elated', 'feel joyful', 'feel cheerful', 'feel ecstatic', 'feel jubilant', 'feel blissful', 'feel overjoyed']],
			[['am happy'],['am pleased', 'am contented', 'am satisfied', 'am elated', 'am joyful', 'am cheerful', 'am ecstatic', 'am jubilant', 'am blissful', 'am overjoyed']],
			[['a dangerous'],['a perilous', 'a hazardous', 'a risky', 'an uncertain', 'an unsafe']],
			[['alright this is'],['this is']],
			[['impossible'],['not possible']],
			[['I am not sure'],['I am uncertain']],
			[['It\'s though'],['It\'s tough']],
			[['though guy'],['tough guy']],
			[['tough I'],['though I']],
			[['tough we'],['though we']],
			[['tough he'],['though he']],
			[['tough she'],['though she']],
			[['tough they'],['though they']],
			[['little drawbacks'],['few drawbacks']],
			// To whom? we do not know so we admit.
			[['granted,'],['admitted,']],
			// Too tense and Hyperbole. 
			[['Thank you very much, everybody.'],['I want to thank everyone']],
			[['I would like to say that'],['']], // you're already talking (?)
			[['we are very much'],['we are']], 
			[['Now consider'],['Consider']], 
			[['So next time'],['Next time']],
			[['now consider'],['consider']], 
			[['so next time'],['next time']],
			[['it is extremely'],['it is']],
 			[['just assumed'],['assumed']],
 			[['is just as'],['is as']],			
			[['is simply'],['is naturally','is simply']],
			[['are simply not'],['are not']],
			[['that\'s frankly'],['that is']],
			[['that\'s, frankly,'],['that is']],
			[['this will put'],['this will place']],
			[['very, very'],['very']],
			[['bazzilion'],['many','plenty of']],
			[['bazillion'],['many','plenty of']],			
			[['millions of times'],['many times','plenty of times']],
			[['in a millions years'],['in a long time']],
			[['a million times'],['many times']],
			[['a thousand times'],['many times','plenty of times']],
			[['thousands of'],['many','numerous','countless']],
			[['a ton of'],['many','a lot']],
			[['got tons of'],['got many','got a lot']],
			[['get tons of'],['get many','get a lot']],
			[['ridiculously low'],['rather low','low']],
			[['ridiculously high'],['rather high','high']],
			[['ridiculously far'],['rather far','far']],			
			[['the best in the world'],['one of the best']],
			[['fastest thing'],['one of the fastest thing']],
			[['two cents to rub together'],['do not have much money']],
			[['older than dirt'],['well aged']],
			[['almost everyone knows'],['it seems common knowledge','it seems redundant to explain','it seems superfluous to explain']],
			[['Almost everyone knows'],['It seems common knowledge','It seems redundant to explain','It seems superfluous to explain']],
			[['everyone knows'],['it seems common knowledge']],
			[['was a mile wide'],['was rather wide']],
			[['was a mile long'],['was rather long']],
			[['I can\'t do anything right'],['I cannot seem to do some things right']],
			[['move mountains'],['do incredible things']],
			[['never let you go'],['not like to let you go']],
			[['nothing can bother'],['most things cannot bother','most things cannot seem to bother','many things cannot seem to bother']],
			[['Nothing can bother'],['Most things cannot bother','Most things cannot seem to bother','Many things cannot seem to bother']],
			[['Nothing can stop'],['most things cannot stop','most things cannot seem to stop','many things cannot seem to stop']],
			[['nothing can stop'],['Most things cannot stop','Most things cannot seem to stop','Many things cannot seem to stop']],
			[['Nothing could ever go wrong'],['most things could not go wrong','most things cannot seem go wrong']],
			[['nothing could ever go wrong'],['Most things could not go wrong','Most things cannot seem go wrong']],
			[['does everything'],['does many things','does plenty of things','does numerous things']],		
			[['As with all good things in life,'],['However,']],
			[['it\'s all in the name of'],['it is for a good cause:']],
			[['I never really'],['I never']],
			[['less and less'],['fewer']],
			[['there are less'],['there are fewer']],
			[['more and more'],['evermore']],
			[['very well'],['well']],		
			[['very, very well'],['well']],		
			[['for a long time'],['for a considerable amount of time']],	
			[['since a long time'],['since a considerable amount of time']],
			[['for what felt like forever'],['for a considerable amount of time']],	
			[['since a long time'],['since a considerable amount of time']],
			[['and one of the things'],['and another thing']],
			[['and one of the things'],['and something']],			
			// Oxford comma in last item of list
			[[', and'],[' and']],
			// continue the statement/comparision, instead of breaking it.
			[['. Or'],[' or']],
			[['. or'],[' or']],
			[['is that when'],['is that, when']],
			[['in most cases.'],['(in most cases).']],
			[[' this is way more'],[', this is way more']],
			[['plus a'],['in addition a']],			
			// Were already here
			[['Here is another'],['Another']],
			[['Here the '],['The ']],
			[['Here is an example'],['An example']],
			// senses or inner experience?
			[['I often see'],['I often notice','I often observe']],
			// we already know the amount is small.			
			[['are a few examples'],['are examples']],
			[['it just puts'],['it puts','it places']],
			[['s more correct than'],['s more fitting than','s more desirable than','s more decorous than']],
			[['s more right than'],['s more fitting than','s more desirable than','s more decorous than']],
			// slangy
			[['my cup of tea'],['my predisposition','my taste']],
			[['is the new black'],['is in vogue','seems commonplace']],
			[['my thing for'],['my proclivity for','my predisposition for','my taste for','my disposition for','my weakness for','my penchant for']],
			[['I have a thing for'],['I have a predisposition for','I have a disposition for','I have a weakness for','I have a penchant for']],
			[['Pro tip:'],['Tip:','Suggestion:']],
			[['Don\'t write:'],['Refrain from writing:']],
			[['probably feel'],['might feel']],
			[['which is exactly how some people'],['which might be close to how some people']],
			[['chock-full'],['brimming','full']],
			[['chock full'],['brimming','full']],
			[['and I beg to differ'],['and I do not agree','and I am not agreeing']],
			[['I beg to differ'],['I do not agree','I am not agreeing']],
			[['Suddenly,'],['All of a sudden,','In a twist,','Unanticipatedly,','Without warning,']], 
			[['hunkered down'],['winced']],
			[['hit the books'],['study']],	
			[['hit the john'],['the toilet']],			
			[['hit the road'],['leave']],	
			[['pass the buck'],['transfer responsibility to someone else']],	
			[['piece of cake'],['easy or effortless']],
			[['a quick recap:'],['in short:']],		
			[['a recap:'],['in short:']],
			[['put up a front'],['act tough', 'appear tough']],
			[['hold your horses'],['wait a minute']],
			[['give her the cold shoulder'],['ignore her']], 
			[['give him the cold shoulder'],['ignore him']],
			[['give me the cold shoulder'],['ignore me']],
			[['give them the cold shoulder'],['ignore them']],	
			[['gave her the cold shoulder'],['ignored her']], 
			[['gave him the cold shoulder'],['ignored him']],
			[['gave me the cold shoulder'],['ignored me']],
			[['gave them the cold shoulder'],['ignored them']],
			[['drives me up the wall'],['irritates me']],
			[['drove me up the wall'],['irritated me']],
			[['around-the-clock'],['all day and night','non-stop']],
			[['24/7'],['all day and night','non-stop']],
			[['have the blues'],['feel depressed','feel sad']],
			[['had the blues'],['felt depressed','felt sad']],			
			[['cold hard cash'],['money']],
			[['cash'],['money']],
			[['couch potato'],['a lazy person']],
			[['I feel you'],['I understand you','I empathize with you']], 
			[['in no time'],['very soon','quickly']], 
			[['in no-time'],['very soon','quickly']], 
			[['of course, no problem'],['of course, you\'re welcome']],
			[['of course, that is no problem'],['you\'re welcome']],	
			[['was a rip-off'],['a scam']],
			[['was ripped-off'],['was scammed','was bamboozled', 'was beguiled', 'was conned', 'was deceived', 'was duped']],
			[['got ripped-off'],['got scammed','got bamboozled', 'got beguiled', 'got conned', 'got deceived', 'got duped']],
			[['it is a rip-off'],['it is overcharged']],
			[['what a rip-off'],['what a scam', 'what a con']],
			[['What\'s up'],['How are you']],		
			[['what\'s up'],['how are you']],
			[['who\'d'],['who would']],	
			[['Who\'d'],['who would']],				
			[['wrap up'],['finish']], 
			[['Wrap up'],['Finish']],
			// Historic/historical
			[['will be a historical'],['will be a historic']], 
			[['was a historic'],['was a historiccal']], 
			// Comparison
			[['greater then'],['greater than']],
			[['bigger then'],['bigger than']],
			[['larger then'],['larger than']],
			[['sizeable then'],['sizeable than']],
			[['colossal then'],['colossal than']],
			[['considerable then'],['considerable than']],
			[['enormous then'],['enormous than']],
			[['fat then'],['fat than']],
			[['full then'],['full than']],
			[['gigantic then'],['gigantic than']],
			[['hefty then'],['hefty than']],
			[['huge then'],['huge than']],
			[['immense then'],['immense than']],
			[['massive then'],['massive than']],
			[['bulky then'],['bulky than']],	
			// Lose, loose. 
			[['what do you have too loose'],['what do you have to lose']],
			[['lose some weight'],['loose some weight']],			
			[['lose weight'],['loose weight']],
			[['are too lose'],['are too loose']],
			[['are to lose'],['are too loose']],
			[['is too lose'],['is too loose']],
			[['is to lose'],['is too loose']],	
			// Compliment/complemented
			[['for the complement'],['for the compliment']],
			[['to compliment this'],['to complement this']],
			[['compliment it'],['complement it']],
			[['and compliment that'],['and complement that']],
			[['previous night'],['the night before']],
			[['Previous night'],['The night before']],
			[['previous day'],['the day before']],
			[['Previous day'],['The day before']],
			[['Yesterday'],['The day before']],
			[['yesterday'],['the day before']],
			// More recommendations from the Chicago style guide. 
			// Capitals
			[['A.D.'] , ['A. D.']],
			[['B.C.'] , ['B. C.']],
			[['C.E.'] , ['C. E.']],
			[['A.M.'] , ['A. M.']],
			[['P.M.'] , ['P. M.']],
			[['Ph. D.'] , ['Ph.D.']],
			[['M. P.'] , ['M.P.' ]],
			[['"o,'] ,['"O,']],
			[['"oh,'] , ['"Oh,']],
			[['Whereas '] , ['Whereas, ']],
			[['Resolved '], ['Resolved, ']],
			//Italics
			[['however, not '], ['however, <em>not</em>']],
			[['however not '], ['however, <em>not</em>']],
			[['However, not '], ['However, <em>not</em>']],
			// Dashes
			[['I recommened:\n'], ['I recommened—\n']],
			// Indivisible
			[['wo-men'], ['women']],
			[['oft-en'], ['often']],
			[['pray-er'], ['prayer']],
			[['wat-er'], ['water']],
			[['noi-sy'], ['noisy']],
			[['-ceous'], ['ceous']],
			[['-cial'], ['cial']],
			[['-cion'], ['cion']],
			[['-cious'], ['cious']],
			[['-geous'], ['geous']],
			[['-gion'], ['gion']],
			[['-gious'], ['gious']],
			[['-sial'], ['sial']],
			[['-sion'], ['sion']],
			[['-tial'], ['tial']],
			[['-tion'], ['tion']],
			[['-tious'], ['tious']],
			[['self suffi'], ['self-suffi']],
			// Angelicized
			[[' attache '], [' attaché ']],
			[[' bric-a-bric '], [' bric-à-bric ']],
			[[' cafe '], [' café']],
			[[' charge \'affairs '], [' chargé d\'affairs ']],
			[[' charge d\'affairs '], [' chargé d\'affairs ']],
			[[' confrere '], [' confrère ']],
			[[' debris '], [' débris ']],
			[[' debut '], [' début ']],
			[[' decollete '], [' décolleté ']],
			[[' denouement '], [' dénouement ']],
			[[' depot '], [' dépôt ']],
			[[' eclat '], [' éclat ']],
			[[' elite '], [' élite ']],
			[[' entree '], [' entrée ']],
			[[' expose '],[' exposé ']],
			[[' facade '], [' façade ']],
			[[' fete '],[' fête ']],
			[[' levee '], [' levée ']],
			[[' matinee '], [' matinée ']],
			[[' melee '], [' mêlée ']],
			[[' naive '], [' naïve ']],
			[[' nee '], [' née ']],
			[[' regime '], [' régime ']],
			[[' resume '], [' résumé ']],
			[[' protoge '], [' protégé ']],
			[[' protege '], [' protégé ']],
			[[' soiree '], [' soirée ']],
			[[' tete-a-tete '], [' tête-à-tête ']],
			[[' vis-a-vis '], [' vis-à-vis ']],
			// Years
			[['the next year.'], ['the following year.']],
			[['The next year'], ['The following year']],
			[['the coming year.'], ['the following year.']],
			[['The coming year'], ['The following year']],			
			// Who knows?
			[['as you probably'],['as you might']],
			// That->who / slangy
			[['the guy that'],['the guy who']],
			[['the gal that'],['the girl who']],
			[['the person that'],['the person who']],			
			[['the individual that'],['the individual who']],	
			[['walk the walk'],['do as expected','do as one says','adhere to']],			
			[['walk the talk'],['do as expected','do as one says','adhere to']],
			[['by the way,'],['in as much as,','incidentally,','relating to,']],
			[['these are huge'],['these are']],		
			[['these are tremendous'],['these are']],	
			[['pitfalls'],['problems']],
			
			// Finish cleaning any mistakes.
			[[',,'],[',']],
			[[', ,'],[',']]			
			
	];
        
	public $misspelled = [
			[['absence'],['abcense','absance']],
			[['acceptable'],['acceptible']],
			[['accidentally'],['accidentaly']],
			[['accidently'],['accidentaly']],
			[['accommodate'],['accomodate','acommodate']],
			[['achieve'],['acheive']],
			[['acknowledge'],['acknowlege','aknowledge']],
			[['acquaintance'],['acquaintence','aquaintance']],
			[['acquire'],['aquire','adquire']],
			[['acquit'],['aquit']],
			[['acreage'],['acrage','acerage']],
			[['address'],['adress']],
			[['adultery'],['adultary']],
			[['advisable'],['adviseable','advizable']],
			[['affect'],['effect']],
			[['aggression'],['agression']],
			[['aggressive'],['agressive']],
			[['allegiance'],['allegaince','allegience','alegiance']],
			[['almost'],['allmost']],
			[['amateur'],['amatuer','amature']],
			[['annually'],['anually','annualy']],
			[['apparent'],['apparant','aparent']],
			[['arctic'],['artic']],
			[['argument'],['arguement']],
			[['atheist'],['athiest']],
			[['awful'],['awfull','aweful']],
			[['because'],['becuase']],
			[['becoming'],['becomeing']],
			[['beginning'],['begining']],
			[['believe'],['beleive']],
			[['bellwether'],['bellweather']],
			[['buoy'],['bouy']],
			[['buoyant'],['bouyant']],
			[['business'],['buisness']],
			[['calendar'],['calender']],
			[['camouflage'],['camoflage','camoflague']],
			[['capitol'],['capital']],
			[['Caribbean'],['Carribean']],
			[['category'],['catagory']],
			[['caught'],['cauhgt','caugt']],
			[['cemetery'],['cemetary','cematery']],
			[['changeable'],['changable']],
			[['chief'],['cheif']],
			[['colleague'],['collaegue','collegue']],
			[['column'],['colum']],
			[['coming'],['comming']],
			[['committed'],['commited','comitted']],
			[['concede'],['conceed']],
			[['congratulate'],['congradulate']],
			[['conscientious'],['consciencious']],
			[['conscious'],['concious','consious']],
			[['consciousness'],['conciousness','consiousness']],
			[['consensus'],['concensus']],
			[['controversy'],['contraversy']],
			[['coolly'],['cooly']],
			[['daiquiri'],['dacquiri','daquiri']],
			[['deceive'],['decieve']],
			[['definite'],['definate','definit']],
			[['definitely'],['definitly','definately','defiantly']],
			[['desperate'],['desparate']],
			[['difference'],['diffrence']],
			[['dilemma'],['dilema']],
			[['disappoint'],['disapoint']],
			[['disastrous'],['disasterous']],
			[['drunkenness'],['drunkeness']],
			[['dumbbell'],['dumbell']],
			[['embarrass'],['embarass']],
			[['equipment'],['equiptment']],
			[['exceed'],['excede']],
			[['exhilarate'],['exilerate']],
			[['existence'],['existance']],
			[['experience'],['experiance']],
			[['extreme'],['extreem']],
			[['fascinating'],['facinating']],
			[['fiery'],['firey']],
			[['fluorescent'],['flourescent']],
			[['foreign'],['foriegn']],
			[['friend'],['freind']],
			[['fulfil'],['fullfil']],
			[['gauge'],['guage']],
			[['grateful'],['gratefull','greatful']],
			[['guarantee'],['garantee','garentee','garanty','gurantee','garuantee']],
			[['guidance'],['guidence']],
			[['goodbye'],['good-bye']],			
			[['harass'],['harrass']],
			[['height'],['heighth','heigth']],
			[['hierarchy'],['heirarchy']],
			[['hors d\'oeuvres'],['hors derves','ordeurves']],
			[['humorous'],['humerous']],
			[['hygiene'],['hygene','hygine','hiygeine','higeine','hygeine']],
			[['hypocrite'],['hipocrit']],
			[['ignorance'],['ignorence']],
			[['imitate'],['immitate']],
			[['immediately'],['imediately']],
			[['indict'],['indite']],
			[['independent'],['independant']],
			[['indispensable'],['indispensible']],
			[['inoculate'],['innoculate']],
			[['intelligence'],['inteligence','intelligance']],
			[['judgment'],['judgement']],
			[['kernel'],['kernal,']],
			[['leisure'],['liesure']],
			[['liaison'],['liason']],
			[['library'],['libary','liberry']],
			[['license'],['lisence']],
			[['lightning'],['lightening']],
			[['maintenance'],['maintainance','maintnance']],
			[['medieval'],['medeval','medevil','mideval']],
			[['memento'],['momento']],
			[['millennium'],['millenium','milennium']],
			[['miniature'],['miniture']],
			[['minuscule'],['miniscule']],
			[['mischievous'],['mischievious','mischevous','mischevious']],
			[['misspell'],['mispell','misspel']],
			[['necessary'],['neccessary','necessery']],
			[['neighbor'],['nieghbor']],
			[['noticeable'],['noticable']],
			[['occasion'],['occassion']],
			[['occasionally'],['occasionaly','occassionally']],
			[['occurrence'],['occurrance','occurence']],
			[['occurred'],['occured']],
			[['omission'],['ommision','omision']],
			[['original'],['orignal']],
			[['outrageous'],['outragous']],
			[['parliament'],['parliment']],
			[['pastime'],['passtime','pasttime']],
			[['perceive'],['percieve']],
			[['perseverance'],['perseverence']],
			[['personnel'],['personell','personel']],
			[['plagiarize'],['plagerize']],
			[['playwright'],['playright','playwrite']],
			[['possession'],['posession','possesion']],
			[['potatoes'],['potatos']],
			[['precede'],['preceed']],
			[['presence'],['presance']],
			[['principle'],['principal']],
			[['privilege'],['privelege','priviledge']],
			[['professor'],['professer']],
			[['promise'],['promiss']],
			[['pronunciation'],['pronounciation']],
			[['prophecy'],['propecy','phropecy']],
			[['percent'],['per cent']],
			[['publicly'],['publically']],
			[['publicly'],['publically']],
			[['quarantine'],['quarentine']],
			[['questionnaire'],['questionaire','questionnair']],
			[['readable'],['readible']],
			[['really'],['realy']],
			[['receive'],['recieve']],
			[['receipt'],['reciept']],
			[['recommend'],['recomend','reccommend']],
			[['referred'],['refered']],
			[['reference'],['referance','refrence']],
			[['relevant'],['relevent','revelant']],
			[['religious'],['religous','religius']],
			[['repetition'],['repitition']],
			[['restaurant'],['restarant','restaraunt']],
			[['rhyme'],['rime']],
			[['rhythm'],['rythm','rythem']],
			[['secretary'],['secratary','secretery']],
			[['seize'],['sieze']],
			[['separate'],['seperate']],
			[['sergeant'],['sargent']],
			[['similar'],['similer']],
			[['skilful'],['skilfull']],
			[['speech'],['speach','speeche']],
			[['successful'],['succesful','successfull','sucessful']],
			[['supersede'],['supercede']],
			[['surprise'],['suprise','surprize']],
			[['tomatoes'],['tomatos']],
			[['tomorrow'],['tommorow','tommorrow']],
			[['twelfth'],['twelth']],
			[['tyranny'],['tyrany']],
			[['underrate'],['underate']],
			[['until'],['untill']],
			[['upholstery'],['upholstry']],
			[['usable'],['usible']],
			[['vacuum'],['vaccuum','vaccum','vacume']],
			[['vehicle'],['vehical']],
			[['vicious'],['visious']],
			[['weather'],['wether']]
	];
	
	public $thesaurus = [

			// thesaurus 
			[['mitigating'],['alleviating','lessen','reduce']],
	    		[['mitigate'],['alleviate','lessen','reduce']],
            		[['beautiful'],['pretty', 'lovely', 'handsome', 'attractive', 'gorgeous', 'dazzling', 'splendid', 'magnificent', 'comely', 'fair', 'ravishing', 'graceful', 'elegant', 'fine', 'exquisite', 'aesthetic', 'pleasing', 'shapely', 'delicate', 'stunning', 'glorious', 'heavenly', 'resplendent', 'radiant', 'glowing', 'blooming', 'sparkling']],
            		[['awful'],['dreadful', 'terrible', 'abominable', 'unpleasant']],
            		[['brave'],['courageous', 'fearless', 'dauntless', 'intrepid', 'plucky', 'daring', 'heroic', 'valorous', 'audacious', 'bold', 'gallant', 'valiant', 'doughty', 'mettlesome']],
		    	[['it breaks'],['it fractures', 'it shatters','it breaks']],
            		[['calm'],['quiet', 'peaceful', 'still', 'tranquil', 'mild', 'serene', 'smooth', 'composed', 'collected', 'unruffled', 'level-headed', 'unexcited', 'detached', 'aloof']],
		    	[['would cry'],['would shout', 'would yell', 'would yowl', 'would scream', 'would roar', 'would bellow', 'would weep', 'would wail', 'would sob', 'bawl']],
            		[['would shout'],['would yell', 'would yowl', 'would scream', 'would roar', 'would bellow', 'would weep', 'would wail', 'would sob', 'bawl']],
			[['delicious'],['savory', 'delectable', 'appetizing', 'luscious', 'scrumptious', 'palatable', 'delightful', 'enjoyable', 'toothsome', 'exquisite']],
            		[['enjoy it'],['appreciate it', 'delight in it', 'bepleased by it','indulge in it','relish it', 'savor it', 'like it']],
            		[['explained'],['elaborated', 'clarified', 'defined']],
		    	[['explain'],['elaborate', 'clarify', 'define','explain']],
            		[['differences'],['dissimilarities','differences']],
		    	[['difference'],['dissimilarity','difference']],
		    	[['delicious'],['savory', 'delectable', 'appetizing', 'luscious', 'scrumptious', 'palatable', 'delightful', 'enjoyable', 'toothsome', 'exquisite']],
		    	[['famous'],['well-known', 'renowned', 'celebrated', 'famed', 'eminent', 'illustrious', 'distinguished', 'noted', 'notorious']],
            		[['a fat'],['a stout', 'a corpulent', 'a fleshy', 'a beefy', 'a paunchy', 'a plump', 'a full', 'a rotund','a bulky']],
			[['funny'],['humorous', 'amusing', 'comical', 'laughable']],
            		[['fast'],['quick', 'rapid', 'speedy', 'fleet', 'hasty', 'snappy']],
           		[['fear'],['fright', 'dread', 'dismay', 'anxiety','apprehension']],
            		[['gross'],['improper', 'coarse', 'indecent', 'crude', 'vulgar', 'outrageous', 'extreme', 'grievous', 'shameful', 'uncouth', 'obscene', 'low']],
            		[['moody'],['temperamental', 'changeable', 'short-tempered', 'glum', 'morose', 'sullen', 'mopish', 'irritable', 'testy', 'peevish', 'fretful', 'spiteful', 'sulky', 'touchy']],
            		[['interesting'],['fascinating','intriguing', 'provocative', 'though-provoking', 'inspiring', 'involving', 'moving', 'titillating', 'tantalizing', 'exciting', 'entertaining', 'piquant', 'lively', 'racy', 'spicy', 'gripping', 'enthralling', 'spellbinding', 'curious', 'captivating', 'enchanting', 'bewitching', 'appealing']],
            		[['good'],['good','excellent', 'fine', 'superior', 'wonderful', 'marvelous', 'qualified', 'suited', 'suitable', 'apt', 'proper', 'superb', 'respectable', 'edifying']],
           		[[' big '],[' enormous ', ' immense ', ' sizable ', ' grand ', ' great ']],
			[['to do '],['to accomplish ', 'to achieve ', 'to attain ']],
			[['a great '],['a noteworthy ', 'a worthy ', 'a distinguished ', 'a remarkable ', 'a grand ', 'a considerable ', 'a powerful ', 'a much ', 'a mighty ']],
            		[['important'],['necessary', 'vital', 'critical', 'indispensable', 'valuable', 'essential', 'significant', 'primary', 'principal']],
            		[['strange '],['odd ', 'peculiar ', 'unusual ', 'unfamiliar ', 'uncommon ', 'curious', 'irregular']],
			[['show '],['display ', 'exhibit ', 'present ', 'reveal ', 'demonstrate ']],
		   	[['wrong '],['incorrect ', 'inaccurate ', 'mistaken ', 'erroneous ', 'improper ', 'unsuitable ']],
            		[['little '],['tiny ', 'small ', 'diminutive ']],
           		[['am right'],['am correct', 'am accurate', 'am factual']],
			[['is right'],['is correct', 'is accurate', 'is factual']],
			[['crazy '],['strange ', 'odd ', 'peculiar ', 'unusual ', 'unfamiliar ', 'uncommon ', 'curious ']]
			
			];	

		    /* OPTIONAL VALUES, BUT PRONE TO FALSE POSITIVES UNSUITABLE FOR AUTO CORRECTION (?)

		    [['mad'],['preposterous', 'irrational', 'distracted', 'aberrant', 'frenetic', 'imprudent', 'unreasonable']],
		    [['angry'],['furious', 'enraged', 'excited', 'wrathful', 'indignant', 'exasperated', 'aroused', 'inflamed']],
		    [['answer'],['reply', 'respond', 'retort', 'acknowledge']],
		    [['ask–'],['question', 'inquireof', 'seekinformationfrom', 'request']],
		    [['awful'],['dreadful', 'terrible', 'abominable', 'unpleasant']],
		    [['bad'],['evil', 'immoral', 'wicked', 'corrupt', 'sinful', 'depraved', 'spoiled', 'tainted', 'harmful', 'injurious', 'unfavorable', 'defective', 'inferior', 'imperfect', 'substandard', 'faulty', 'improper', 'inappropriate', 'unsuitable', 'disagreeable', 'unpleasant', 'unfriendly', 'irascible', 'horrible', 'atrocious', 'outrageous', 'scandalous', 'noxious', 'sinister', 'putrid', 'snide', 'deplorable', 'dismal', 'heinous', 'nefarious', 'obnoxious', 'detestable', 'despicable', 'contemptible', 'rank', 'ghastly', 'execrable']],
		    [['evil'],['immoral', 'wicked', 'corrupt', 'sinful', 'depraved', 'spoiled', 'tainted', 'harmful', 'injurious', 'unfavorable', 'defective', 'inferior', 'imperfect', 'substandard', 'faulty', 'improper', 'inappropriate', 'unsuitable', 'disagreeable', 'unpleasant', 'unfriendly', 'irascible', 'horrible', 'atrocious', 'outrageous', 'scandalous', 'noxious', 'sinister', 'putrid', 'snide', 'deplorable', 'dismal', 'heinous', 'nefarious', 'obnoxious', 'detestable', 'despicable', 'contemptible', 'rank', 'ghastly', 'execrable']],
		    [['beautiful'],['pretty', 'lovely', 'handsome', 'attractive', 'gorgeous', 'dazzling', 'splendid', 'magnificent', 'comely', 'fair', 'ravishing', 'graceful', 'elegant', 'fine', 'exquisite', 'aesthetic', 'pleasing', 'shapely', 'delicate', 'stunning', 'glorious', 'heavenly', 'resplendent', 'radiant', 'glowing', 'blooming', 'sparkling']],
		    [['begin'],['start', 'open', 'launch', 'initiate', 'commence', 'inaugurate', 'originate']],
		    [['big'],['enormous', 'immense', 'sizable', 'grand', 'great', 'tall', 'substantial', 'ample', 'broad', 'expansive', 'spacious', 'stout', 'tremendous', 'mountainous']],
		    [['brave'],['courageous', 'fearless', 'dauntless', 'intrepid', 'plucky', 'daring', 'heroic', 'valorous', 'audacious', 'bold', 'gallant', 'valiant', 'doughty', 'mettlesome']],
		    [['breaks'],['fractures', 'shatters']],
		    [['a break'],['a pause']],
		    [['bright'],['shining', 'shiny', 'gleaming', 'brilliant', 'sparkling', 'shimmering', 'radiant', 'vivid', 'colorful', 'lustrous', 'luminous', 'incandescent', 'intelligent', 'knowing', 'quick-witted', 'smart', 'intellectual']],
		    [['calm'],['quiet', 'peaceful', 'still', 'tranquil', 'mild', 'serene', 'smooth', 'composed', 'collected', 'unruffled', 'level-headed', 'unexcited', 'detached', 'aloof']],
		    [['come'],['approach', 'advance', 'near', 'arrive', 'reach']],
		    [['cool'],['chilly', 'cold', 'frosty', 'wintry', 'icy', 'frigid']],
		    [['crooked'],['bent', 'twisted', 'curved', 'hooked', 'zigzag']],
		    [['cry'],['shout', 'yell', 'yowl', 'scream', 'roar', 'bellow', 'weep', 'wail', 'sob', 'bawl']],
		    [['cut'],['slash', 'sever']],
		    [['dangerous'],['perilous', 'hazardous', 'risky', 'uncertain', 'unsafe']],
		    [['dark'],['shadowy', 'unlit', 'murky', 'gloomy', 'dim', 'dusky', 'shaded', 'sunless', 'dismal', 'sad']],
		    [['decide'],['determine', 'settle', 'choose', 'resolve']],
		    [['definite'],['certain', 'sure', 'determined', 'clear', 'distinct', 'obvious']],
		    [['delicious'],['savory', 'delectable', 'appetizing', 'luscious', 'scrumptious', 'palatable', 'delightful', 'enjoyable', 'toothsome', 'exquisite']],
		    [['describe'],['portray', 'characterize', 'picture', 'narrate', 'relate', 'recount', 'represent', 'report', 'record']],
		    [['destroy'],['ruin', 'demolish', 'raze', 'waste', 'kill', 'slay', 'end', 'extinguish']],
		    [['difference'],['disagreement', 'inequity', 'contrast', 'dissimilarity', 'incompatibility']],
		    [['do'],['accomplish', 'achieve', 'attain']],
		    [['dull'],['boring', 'tiring','tiresome', 'uninteresting', 'slow', 'dumb', 'stupid', 'unimaginative', 'lifeless', 'dead', 'insensible', 'tedious', 'wearisome', 'listless', 'expressionless', 'plain', 'monotonous', 'humdrum', 'dreary']],
		    [['eager'],['keen', 'fervent', 'enthusiastic', 'involved', 'interested', 'aliveto']],
		    [['end'],['stop', 'finish', 'terminate', 'conclude', 'close', 'halt', 'cessation', 'discontinuance']],
		    [['enjoy'],['appreciate', 'delightin', 'bepleased', 'indulgein', 'luxuriatein', 'baskin', 'relish', 'devour', 'savor', 'like']],
		    [['explain'],['elaborate', 'clarify', 'define', 'interpret', 'justify', 'accountfor']],
		    [['fair'],['just', 'impartial', 'unbiased', 'objective', 'unprejudiced', 'honest']],
		    [['fall'],['drop', 'descend', 'plunge', 'topple', 'tumble']],
		    [['false'],['fake', 'fraudulent', 'counterfeit', 'spurious', 'untrue', 'unfounded', 'erroneous', 'deceptive', 'groundless', 'fallacious']],
		    [['famous'],['well-known', 'renowned', 'celebrated', 'famed', 'eminent', 'illustrious', 'distinguished', 'noted', 'notorious']],
		    [['fast'],['quick', 'rapid', 'speedy', 'fleet', 'hasty', 'snappy', 'mercurial', 'swiftly', 'rapidly', 'quickly', 'snappily', 'speedily', 'lickety-split', 'posthaste', 'hastily', 'expeditiously', 'likeaflash']],
		    [['fat'],['stout', 'corpulent', 'fleshy', 'beefy', 'paunchy', 'plump', 'full', 'rotund', 'tubby', 'pudgy', 'chubby', 'chunky', 'burly', 'bulky', 'elephantine']],
		    [['fear'],['fright', 'dread', 'terror', 'alarm', 'dismay', 'anxiety', 'scare', 'awe', 'horror', 'panic', 'apprehension']],
		    [['fly'],['soar', 'hover', 'flit', 'wing', 'flee', 'waft', 'glide', 'coast', 'skim', 'sail', 'cruise']],
		    [['funny'],['humorous', 'amusing', 'droll', 'comic', 'comical', 'laughable', 'silly']],
		    [['get'],['acquire', 'obtain', 'secure', 'procure', 'gain', 'fetch', 'find', 'score', 'accumulate', 'win', 'earn', 'rep', 'catch', 'net', 'bag', 'derive', 'collect', 'gather', 'glean', 'pickup', 'accept', 'comeby', 'regain', 'salvage']],
		    [['go'],['recede', 'depart', 'fade', 'disappear', 'move', 'travel', 'proceed']],
		    [['good'],['excellent', 'fine', 'superior', 'wonderful', 'marvelous', 'qualified', 'suited', 'suitable', 'apt', 'proper', 'capable', 'generous', 'kindly', 'friendly', 'gracious', 'obliging', 'pleasant', 'agreeable', 'pleasurable', 'satisfactory', 'well-behaved', 'obedient', 'honorable', 'reliable', 'trustworthy', 'safe', 'favorable', 'profitable', 'advantageous', 'righteous', 'expedient', 'helpful', 'valid', 'genuine', 'ample', 'salubrious', 'estimable', 'beneficial', 'splendid', 'great', 'noble', 'worthy', 'first-rate', 'top-notch', 'grand', 'sterling', 'superb', 'respectable', 'edifying']],
		    [['great'],['noteworthy', 'worthy', 'distinguished', 'remarkable', 'grand', 'considerable', 'powerful', 'much', 'mighty']],
		    [['gross'],['improper', 'coarse', 'indecent', 'crude', 'vulgar', 'outrageous', 'extreme', 'grievous', 'shameful', 'uncouth', 'obscene', 'low']],
		    [['happy'],['pleased', 'contented', 'satisfied', 'delighted', 'elated', 'joyful', 'cheerful', 'ecstatic', 'jubilant', 'gay', 'tickled', 'gratified', 'glad', 'blissful', 'overjoyed']],
		    [['hate'],['despise', 'loathe', 'detest', 'abhor', 'disfavor', 'dislike', 'disapprove', 'abominate']],
		    [['help'],['aid', 'assist', 'support', 'encourage', 'back', 'waiton', 'attend', 'serve', 'relieve', 'succor', 'benefit', 'befriend', 'abet']],
		    [['hide'],['conceal', 'cover', 'mask', 'cloak', 'camouflage', 'screen', 'shroud', 'veil']],
		    [['hurry'],['rush', 'run', 'speed', 'race', 'hasten', 'urge', 'accelerate', 'bustle']],
		    [['hurt'],['damage', 'harm', 'injure', 'wound', 'distress', 'afflict', 'pain']],
		    [['idea'],['thought', 'concept', 'conception', 'notion', 'understanding', 'opinion', 'plan', 'view', 'belief']],
		    [['important'],['necessary', 'vital', 'critical', 'indispensable', 'valuable', 'essential', 'significant', 'primary', 'principal', 'considerable', 'famous', 'distinguished', 'notable', 'well-known']],
		    [['interesting'],['fascinating', 'engaging', 'sharp', 'keen', 'bright', 'intelligent', 'animated', 'spirited', 'attractive', 'inviting', 'intriguing', 'provocative', 'though-provoking', 'challenging', 'inspiring', 'involving', 'moving', 'titillating', 'tantalizing', 'exciting', 'entertaining', 'piquant', 'lively', 'racy', 'spicy', 'engrossing', 'absorbing', 'consuming', 'gripping', 'arresting', 'enthralling', 'spellbinding', 'curious', 'captivating', 'enchanting', 'bewitching', 'appealing']],
		    [['keep'],['hold', 'retain', 'withhold', 'preserve', 'maintain', 'sustain', 'support']],
		    [['kill'],['slay', 'execute', 'assassinate', 'destroy', 'cancel', 'abolish']],
		    [['lazy'],['indolent', 'slothful', 'idle', 'inactive', 'sluggish']],
		    [['little'],['tiny', 'small', 'diminutive', 'runt', 'miniature', 'puny', 'exiguous', 'dinky', 'cramped', 'limited', 'slight', 'petite', 'minute']],
		    [['look'],['gaze', 'see', 'glance', 'watch', 'survey', 'study', 'seek', 'searchfor', 'peek', 'peep', 'glimpse', 'stare', 'contemplate', 'examine', 'gape', 'ogle', 'scrutinize', 'inspect', 'leer', 'behold', 'observe', 'view', 'witness', 'perceive', 'spy', 'sight', 'discover', 'notice', 'recognize', 'peer', 'eye', 'gawk', 'peruse', 'explore']],
		    [['love'],['like', 'admire', 'esteem', 'fancy', 'carefor', 'cherish', 'adore', 'treasure', 'worship', 'appreciate', 'savor']],
		    [['make'],['create', 'originate', 'invent', 'beget', 'form', 'construct', 'design', 'fabricate', 'manufacture', 'produce', 'build', 'develop', 'do', 'effect', 'execute', 'compose', 'perform', 'accomplish', 'earn', 'gain', 'obtain', 'acquire', 'get']],
		    [['mark'],['label', 'tag', 'price', 'ticket', 'impress', 'effect', 'trace', 'imprint', 'stamp', 'brand', 'sign', 'note', 'heed', 'notice', 'designate']],
		    [['mischievous'],['prankish', 'playful', 'naughty', 'roguish', 'waggish', 'impish', 'sportive']],
		    [['move'],['plod', 'go', 'creep', 'crawl', 'inch', 'poke', 'drag', 'toddle', 'shuffle', 'trot', 'dawdle', 'walk', 'traipse', 'mosey', 'jog', 'plug', 'trudge', 'slump', 'lumber', 'trail', 'lag', 'run', 'sprint', 'trip', 'bound', 'hotfoot', 'high-tail', 'streak', 'stride', 'tear', 'breeze', 'whisk', 'rush', 'dash', 'dart', 'bolt', 'fling', 'scamper', 'scurry', 'skedaddle', 'scoot', 'scuttle', 'scramble', 'race', 'chase', 'hasten', 'hurry', 'hump', 'gallop', 'lope', 'accelerate', 'stir', 'budge', 'travel', 'wander', 'roam', 'journey', 'trek', 'ride', 'spin', 'slip', 'glide', 'slide', 'slither', 'coast', 'flow', 'sail', 'saunter', 'hobble', 'amble', 'stagger', 'paddle', 'slouch', 'prance', 'straggle', 'meander', 'perambulate', 'waddle', 'wobble', 'pace', 'swagger', 'promenade', 'lunge']],
		    [['moody'],['temperamental', 'changeable', 'short-tempered', 'glum', 'morose', 'sullen', 'mopish', 'irritable', 'testy', 'peevish', 'fretful', 'spiteful', 'sulky', 'touchy']],
		    [['neat'],['clean', 'orderly', 'tidy', 'trim', 'dapper', 'natty', 'smart', 'elegant', 'well-organized', 'super', 'desirable', 'spruce', 'shipshape', 'well-kept', 'shapely']],
		    [['new'],['fresh', 'unique', 'original', 'unusual', 'novel', 'modern', 'recent']],
		    [['old'],['feeble', 'frail', 'aged']],
		    [['part'],['portion', 'share', 'piece', 'allotment', 'section', 'fraction', 'fragment']],
		    [['place'],['space', 'area', 'spot', 'plot', 'region', 'location', 'situation', 'position', 'residence', 'dwelling', 'set', 'site', 'station', 'status', 'state']],
		    [['plan'],['plot', 'scheme', 'design', 'draw', 'map', 'diagram', 'procedure', 'arrangement', 'intention', 'device', 'contrivance', 'method', 'way', 'blueprint']],
		    [['popular'],['well-liked', 'approved', 'accepted', 'favorite', 'celebrated']],
		    [['predicament'],['quandary', 'dilemma', 'pickle', 'problem', 'plight', 'spot', 'scrape', 'jam']],
		    [['put'],['place', 'set', 'attach', 'establish', 'assign', 'keep', 'save', 'setaside', 'effect', 'achieve', 'do', 'build']],
		    [['quiet'],['silent', 'still', 'soundless', 'mute', 'tranquil', 'peaceful', 'calm', 'restful']],
		    [['right'],['correct', 'accurate', 'factual', 'true', 'good', 'just', 'honest', 'upright', 'lawful', 'moral', 'proper', 'suitable', 'apt', 'legal', 'fair']],
		    [['run'],['race', 'speed', 'hurry', 'hasten', 'sprint', 'dash', 'rush', 'escape', 'elope', 'flee']],
		    [['scared'],['afraid', 'frightened', 'alarmed', 'terrified', 'panicked', 'fearful', 'unnerved', 'insecure', 'timid', 'shy', 'skittish', 'jumpy', 'disquieted', 'worried', 'vexed', 'troubled', 'disturbed', 'horrified', 'terrorized', 'shocked', 'petrified', 'haunted', 'timorous', 'shrinking', 'tremulous', 'stupefied', 'paralyzed', 'stunned', 'apprehensive']],
		    [['show'],['display', 'exhibit', 'present', 'note', 'pointto', 'indicate', 'explain', 'reveal', 'prove', 'demonstrate', 'expose']],
		    [['slow'],['unhurried', 'gradual', 'leisurely', 'late', 'behind', 'tedious', 'slack']],
		    [['stop'],['cease', 'halt', 'stay', 'pause', 'discontinue', 'conclude', 'end', 'finish', 'quit']],
		    [['story'],['tale', 'myth', 'legend', 'fable', 'yarn', 'account', 'narrative', 'chronicle', 'epic', 'sage', 'anecdote', 'record', 'memoir']],
		    [['strange'],['odd', 'peculiar', 'unusual', 'unfamiliar', 'uncommon', 'queer', 'weird', 'outlandish', 'curious', 'unique', 'exclusive', 'irregular']],
		    [['take'],['hold', 'catch', 'seize', 'grasp', 'win', 'capture', 'acquire', 'pick', 'choose', 'select', 'prefer', 'remove', 'steal', 'lift', 'rob', 'engage', 'bewitch', 'purchase', 'buy', 'retract', 'recall', 'assume', 'occupy', 'consume']],
		    [['tell'],['disclose', 'reveal', 'show']],
		    [['trouble'],['distress', 'anguish', 'anxiety', 'worry', 'wretchedness', 'pain', 'danger', 'peril', 'disaster', 'grief', 'misfortune', 'difficulty', 'concern', 'pains', 'inconvenience', 'exertion', 'effort']],
		    [['true'],['accurate', 'right', 'proper', 'precise', 'exact', 'valid', 'genuine', 'real', 'actual', 'trusty', 'steady', 'loyal', 'dependable', 'sincere', 'staunch']],
		    [['ugly'],['hideous', 'frightful', 'frightening', 'shocking', 'horrible', 'unpleasant', 'monstrous', 'terrifying', 'gross', 'grisly', 'ghastly', 'horrid', 'unsightly', 'plain', 'homely', 'evil', 'repulsive', 'repugnant', 'gruesome']],
		    [['unhappy'],['miserable', 'uncomfortable', 'wretched', 'heart-broken', 'unfortunate', 'poor', 'downhearted', 'sorrowful', 'depressed', 'dejected', 'melancholy', 'glum', 'gloomy', 'dismal', 'discouraged', 'sad']],
		    [['wrong'],['incorrect', 'inaccurate', 'mistaken', 'erroneous', 'improper', 'unsuitable']]
				*/	
		
}


?>
