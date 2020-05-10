<?php

class thesaurus {

    public function __construct($params = array())
    {
        $this->init($params);
    }

    /**
     * Initializes object.
     * @param array $params
     * @throws Exception
    */

    public function init($params)
    {
        try
        {
            isset($params['var']) ? $this->var = $params['var'] : false;
        }
        catch(Exception $e)
        {
            $this->message('Problem initializing:' . $e->getMessage());
        }
    }

	public $thesaurus = [
		// thesaurus array
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
		[['crazy '],['strange ', 'odd ', 'peculiar ', 'unusual ', 'unfamiliar ', 'uncommon ', 'curious ']],
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
	];	
}
?>
