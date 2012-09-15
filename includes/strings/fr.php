<?php
// Pages' head strings
$str['index'] = 'Accueil';
$str['sch_editor'] = '�diteur de styles de partie';
$str['view_counting_date'] = '30 ao�t 2012';
$str['category'] = '�diteur de styles de partie pour W:A';

// Main page
$str['sch_editor_main_page_title'] = '�diteur de styles de partie pour Worms Armageddon';
$str['sch_editor_main_page_content'] = 'Bienvenue dans l\'�diteur de styles de partie pour Worms Armageddon. Ici, vous pourrez consulter les styles de partie cr��s par les utilisateurs et les t�l�charger, voire cr�er vos propres styles de partie. Amusez-vous bien.';

// Errors
$str['error'] = 'Erreur';
$str['error_invalid_action'] = 'Action invalide.';
$str['error_no_action'] = 'Que voulez-vous faire au juste ? Si vous ne savez pas ce que vous voulez faire �a marchera pas...';
$str['error_scheme_name_by_scheme_author_already_exists'] = 'Un scheme portant ce nom-l� et du m�me auteur existe d�j�. L\'�diteur va le num�roter.';

// Scheme list page
$str['sch_editor_sch_list_title'] = 'Liste des schemes';
$str['sch_editor_sch_list_pages_label'] = 'Pages :';

// Scheme maker/editor page
$str['sch_editor_sch_maker_title'] = 'Cr�er un scheme';

$str['sch_editor_sch_name'] = 'Nom du scheme';
$str['sch_editor_sch_name_hint'] = '� moins que le fait que votre scheme s\'appelle scheme non-nomm� en anglais suivi du nombre de secondes �coul�es depuis le 01/01/1970 (timestamp) ne vous pose aucun probl�me, vous devriez donner un nom � votre scheme.';
$str['sch_editor_sch_author'] = 'Votre pseudo';
$str['sch_editor_sch_author_hint'] = 'Champ optionnel. Si vous n\'indiquez aucun pseudo, votre pseudo sera Anonymous dans la base de donn�es.';
$str['sch_editor_sch_password'] = 'Mot de passe d\'�dition du scheme';
$str['sch_editor_sch_password_hint'] = 'Cela vous permettra d\'�diter le scheme � l\'avenir, m�me si vous ne vous �tes pas inscrit sur le site.';
$str['sch_editor_sch_desc'] = 'Description du scheme';
$str['sch_editor_sch_desc_hint'] = 'D�crivez votre scheme ici ! Indiquez :</span>
<ul class="sch_editor_hint">
<li>les r�gles sp�ciales, s\'il y en a ;</li>
<li>le nombre de vers par �quipe conseill� ;</li>
<li>le type de maps � utiliser, s\'il faut des maps sp�ciales...</li>
</ul>';

$str['ammo'] = 'Munitions';
$str['barrels'] = 'Barils'; 
$str['both'] = 'Les deux';
$str['crate_probability'] = 'Caisses';
$str['default'] = 'Par d�faut';
$str['delay'] = 'D�lai';
$str['health_points_abbr'] = 'PV';
$str['hint'] = 'Infos';
$str['infinite'] = 'Infini';
$str['manual'] = 'Manuel';
$str['mines'] = 'Mines';
$str['none'] = 'Aucun';
$str['none_2'] = 'Aucune';
$str['on'] = 'On';
$str['off'] = 'Off';
$str['power'] = 'Puissance';
$str['random'] = 'Al�atoire';
$str['utilities'] = 'Utilitaires';
$str['warning'] = 'Attention :';
$str['weapon'] = 'Arme';
$str['weapons_list'] = array('Jet Pack', 'Faible pesanteur', 'Marche rapide', 'Vis�e laser', 'Invisibilit�', 'Bazooka', 'Missile autoguid�', 'Mortier', 'Pigeon voyageur', 'Lance-mouton', 'Grenade', 'Bombe � fragments', 'Bombe banane', 'Hache d\'armes', 'S�isme', 'Fusil de chasse', 'Pistolet', 'Uzi', 'Minicanon', 'Arc', 'Coup de poing de feu', 'Dragon Ball', 'Kamikaze', 'Bombardier kamikaze', 'Pouss�e', 'Dynamite', 'Mine', 'Mouton', 'Super Mouton', 'Bombe taupe', 'Raid a�rien', 'Attaque au napalm', 'Attaque postale', 'Raid de mines', 'Esquadron de taupes', 'Chalumeau', 'Foreuse pneumatique', 'Poutre', 'Batte de base-ball', 'Kit de d�marrage de poutres', 'Corde ninja', '�lastique', 'Parachute', 'T�l�porteur', 'Balance de la justice', 'Super bombe banane', 'Grenade sacr�e', 'Lance-flammes', 'Arm�e du salut', 'Bombe MB', 'Cocktail molotov', 'Mouflette', 'Vase Ming pr�cieux', 'Attaque au mouton fran�ais', 'Bombe en tapis de Mike', 'Vache folle', 'Vieille femme', '�ne de ciment', 'Test nucl�aire indien', 'Armageddon', 'S�lection de ver', 'Gel', 'Balle magique de Patsy');
$str['weapons_hint']['jetpack'] = 'Dans la colonne puissance, les valeurs indiquent la quantit� de carburant, pas la valeur de l\'octet. Si vous mettez 0 (carburant infini), il y a un compteur qui augmente � chaque unit� de carburant utilis�e. Cette option n\'a d\'effet qu\'� partir de la version 3.6.29.0. Valeur par d�faut : 30.';
$str['weapons_hint']['utilities'] = 'Vous ne pouvez pas �diter les chances pour qu\'un utilitaire apparaisse dans une caisse.';
$str['weapons_hint']['super_weapon'] = 'Cette arme est une super arme, vous ne pouvez donc pas en �diter sa puissance ou ses chances d\'appara�tre dans les caisses.';
$str['weapons_hint']['select_worm'] = 'Les chances pour que la s�lection de ver apparaisse dans une caisse est � 0,5. Elle appara�tra toujours si les super-armes sont d�sactiv�es et si toutes les autres armes sont r�gl�es pour ne jamais appara�tre dans les caisses. Si vous voulez que la s�lection de ver n\'apparaisse jamais dans les caisses, mettez soit une infinit� de munitions, soit un d�lai infini.';
$str['weapons_hint']['girder_starter_pack'] = 'La *puissance* du Kit de d�marrage de poutres d�pend de celle de la poutre.';
$str['weapons_hint']['girder'] = 'En d�finissant la puissance de la poutre, vous d�finissez � quelle distance maximale vous pouvez la placer.';
$str['weapons_hint']['ninja_rope'] = 'En d�finissant la puissance de la corde ninja, vous d�finissez le nombre maximal de r�p�titions, la longueur maximale et l\'angle minimal. 5 = balancements infinis.';

$str['sch_editor_time_settings'] = 'Options de temps';
$str['sch_editor_hotseat_delay'] = 'Temps de r�flexion avant les tours';
$str['sch_editor_hotseat_delay_hint'] = 'Correspond au petit compte � rebours qui appara�t avant le d�but des tours. Toute action interrompt ce compte � rebours et fait commencer le tour. Valeur maximale conseill�e : 15 secondes.';
$str['sch_editor_retreat_time'] = 'Temps de retraite';
$str['sch_editor_retreat_time_hint'] = 'D�finissez le temps que les joueurs ont pour se replier une fois qu\'ils ont tir�.';
$str['sch_editor_rope_retreat_time'] = 'Temps de retraite apr�s avoir attaqu� depuis la corde';
$str['sch_editor_rope_retreat_time_hint'] = 'D�finissez le temps que les joueurs ont pour se replier une fois qu\'ils ont tir� depuis la corde ninja ou tout autre utilitaire.';
$str['sch_editor_turn_time'] = 'Temps de tour';
$str['sch_editor_turn_time_hint'] = 'Tapez 128 pour que le temps de tour soit infini.';
$str['sch_editor_round_time'] = 'Temps de la manche';
$str['sch_editor_round_time_hint'] = 'Il peut �tre sp�cifi� en minutes (de 0 � 127) ou en secondes (de 1 � 128). La mort subite s\'enclenchera quelques tours apr�s que le temps de la manche n\'atteigne 0. Mettre 0 min donnera toujours une mort subite imm�diate par contre.';
$str['sch_editor_round_time_display'] = 'Afficher le temps de la manche';
$str['sch_editor_round_time_display_hint'] = 'Si cette case est coch�e, le temps de la manche sera affich� sous le temps de tour pendant la partie, comme �a les joueurs peuvent savoir le temps qui reste avant la mort subite.';

$str['sch_editor_game_settings'] = 'Options de jeu';
$str['sch_editor_fall_damage'] = 'D�g�ts de chute';
$str['sch_editor_fall_damage_hint'] = 'Les points de vie que perdent les vers en tombant. Vous pouvez d�finir cette valeur en pourcentage ; le nombre que vous indiquez doit �tre compris entre 0 et 508 et doit �tre divisible par 4. Si vous d�sactivez les d�g�ts de chute, les vers perdront quand m�me leur tour en tombant.';
$str['sch_editor_anchor_mode'] = 'Mode artillerie';
$str['sch_editor_anchor_mode_hint'] = 'Les vers ne peuvent ni sauter ni marcher.';
$str['sch_editor_stockpiling_mode'] = 'Stockage des munitions';
$str['sch_editor_stockpiling_mode_acc'] = 'Accumulatif';
$str['sch_editor_stockpiling_mode_anti'] = 'Anti-accumulatif';
$str['sch_editor_stockpiling_mode_hint'] = '[Parties � plusieurs manches] Off : les munitions sont r�initialis�es � chaque manche. Accumulatif : les nouvelles munitions sont ajout�es aux munitions qu\'il restait apr�s la manche pr�c�dente. Anti-accumulatif : les munitions sont d�finies une fois pour toutes au d�but de la premi�re manche, ce qui fait qu\'une fois qu\'une munition est utilis�e, vous ne la retrouverez plus dans les manches suivantes.';
$str['sch_editor_worm_select'] = 'S�lection de ver';
$str['sch_editor_worm_select_hint'] = 'Comment sera choisi le ver qui jouera au prochain tour ? Si vous mettez Al�atoire, le scheme n�cessitera la version 3.6.29.0 ou ult�rieure pour �tre jou�.';
$str['sch_editor_donor_cards'] = 'Cartes de donneur';
$str['sch_editor_donor_cards_hint'] = 'Si cette option est activ�e, une carte de donneur appara�tra lorsqu\'une �quipe dispara�t.';
$str['sch_editor_worm_placement'] = 'Placement des vers';
$str['sch_editor_worm_placement_hint'] = 'Est-ce que le joueur pourra t�l�porter ses vers o� il veut au d�but de la partie ?';
$str['sch_editor_initial_worm_energy'] = '�nergie initiale des vers';
$str['sch_editor_initial_worm_energy_hint'] = 'La quantit� d\'�nergie avec laquelle chaque ver commence la partie. Elle peut �tre modifi�e avec les handicaps.';
$str['sch_editor_number_of_victories'] = 'Nombre de victoires requises';
$str['sch_editor_number_of_victories_hint'] = 'Si vous mettez 0, la partie durera toujours une manche (version 3.6.29.0 ou ult�rieure requise), m�me si elle se termine par une �galit�. Valeur maximale conseill�e : 3 victoires.';

$str['sch_editor_sudden_death_settings'] = 'Options de la mort subite';
$str['sch_editor_sudden_death_event'] = 'Type de mort subite';
$str['sch_editor_sudden_death_event_hint'] = 'Que se passe-t-il si le temps de la manche arrive � 0 ?';
$str['sch_edit_sd_round_ends'] = 'Fin de la manche';
$str['sch_edit_sd_nuke'] = 'Test nucl�aire';
$str['sch_edit_sd_1hp'] = 'Tous les vers ont 1 PV';
$str['sch_edit_sd_water_rise_only'] = 'Mont�e de l\'eau uniquement';
$str['sch_editor_water_rise_speed'] = 'Vitesse de la mont�e de l\'eau';
$str['sch_editor_water_rise_speed_hint'] = 'La vitesse est en pixels par tour.';

$str['sch_editor_crate_probability_settings'] = 'Options des probabilit�s des caisses';
$str['sch_editor_weapon_crate_probability'] = 'Probabilit� des caisses d\'armes';
$str['sch_editor_weapon_crate_probability_hint'] = 'En pourcentages :';
$str['sch_editor_health_crate_probability'] = 'Probabilit� des caisses de sant�';
$str['sch_editor_health_crate_probability_hint'] = 'En pourcentages :';
$str['sch_editor_utility_crate_probability'] = 'Probabilit� des caisses d\'utilitaires';
$str['sch_editor_utility_crate_probability_hint'] = 'En pourcentages :';
$str['sch_editor_health_crate_energy'] = '�nergie contenue dans les caisses de sant�';
$str['sch_editor_health_crate_energy_hint'] = 'Combien de points de vie un ver gagnera-t-il s\'il ramasse une caisse de sant� ?';
$str['sch_editor_turns_without_crates'] = 'Tours sans caisses';
$str['sch_editor_turns_without_crates_hint'] = 'En pourcentages :';

$str['sch_editor_hazardous_objects_settings'] = 'Options des objets al�atoires';
$str['sch_editor_object_type'] = 'Types d\'objets';
$str['sch_editor_object_type_hint'] = 'Y aura-t-il des objets sur le terrain ? Si oui, quel genre d\'objets ? Des mines ? Des barils ? Les deux ?';
$str['sch_editor_object_count'] = 'Nombre maximum d\'objets';
$str['sch_editor_object_count_hint'] = 'Combien y aura-t-il des objets sur le terrain ? Vous pouvez d�finir le nombre maximum d\'objets qu\'il y aura sur le terrain.';
$str['sch_editor_mine_fuse'] = 'D�tonateur des mines';
$str['sch_editor_mine_fuse_hint'] = 'Une fois qu\'une mine est d�clench�e, combien de temps faut-il attendre avant qu\'elle n\'explose ? Attention : cette option ne s\'applique pas aux mines pos�es par les joueurs. Si vous mettez 4, le d�tonateur sera en fait Al�atoire (de 0 � 3s).';
$str['sch_editor_dud_mines'] = 'Mines mortes';
$str['sch_editor_dud_mines_hint'] = 'Si vous activez cette option, certaines mines sur le terrain n\'exploseront pas du tout.';

$str['sch_editor_rubber_settings'] = 'Options de Rubber Worm';
$str['sch_editor_rubber_settings_warning'] = 'Attention : Ces options requi�rent WormKit et le module wkRubberWorm. Si vous modifiez une de ces options, le scheme causera des d�syncronisations entre les joueurs ayant RubberWorm et les joueurs ne l\'ayant pas. Pour d�sactiver une option dont la valeur est un nombre, mettez 0.';
$str['sch_editor_rubber_sdet'] = 'Tirer met fin au tour';
$str['sch_editor_rubber_sdet_hint'] = 'Par d�faut, cette option est activ�e.';
$str['sch_editor_rubber_usw'] = 'D�verrouiller certaines armes dans le mode "Tirer ne met pas fin au tour"';
$str['sch_editor_rubber_usw_hint'] = 'Cela d�verrouille le s�isme, le test nucl�aire indien et l\'Armageddon lorsque tirer ne met pas fin au tour. Requiert RubberWorm31.';
$str['sch_editor_rubber_ldet'] = 'Perdre le contr�le du ver met fin au tour';
$str['sch_editor_rubber_ldet_hint'] = 'Par d�faut, cette option est activ�e.';
$str['sch_editor_rubber_fdpt'] = 'Tirer n\'interrompt pas le temps de tour';
$str['sch_editor_rubber_fdpt_hint'] = 'Utile lorsque tirer ne met pas fin au tour.';
$str['sch_editor_rubber_improved_rope'] = 'Corde ninja am�lior�e';
$str['sch_editor_rubber_improved_rope_hint'] = 'Si cette option est activ�e, la corde fonctionnera comme dans Worms 2 (possibilit� de tirer en bas, plus grande acc�l�ration).';
$str['sch_editor_rubber_ccs'] = 'Pluie de caisses continuelle';
$str['sch_editor_rubber_ccs_hint'] = 'Des caisses tomberont toutes les 5 secondes.';
$str['sch_editor_rubber_ope'] = 'Les objets peuvent �tre pouss�s par les explosions';
$str['sch_editor_rubber_ope_hint'] = 'Requiert RubberWorm31.';
$str['sch_editor_rubber_wdca'] = 'L\'arme ne change pas automatiquement';
$str['sch_editor_rubber_wdca_hint'] = 'Utile lorsque tirer ne met pas fin au tour. Requiert RubberWorm31.';
$str['sch_editor_rubber_fuseex'] = 'Plus grand d�tonateur';
$str['sch_editor_rubber_fuseex_hint'] = 'Le d�tonateur peut �tre mis jusqu\'� 9 secondes au lieu de 5 si cette option est activ�e. Requiert RubberWorm31.';
$str['sch_editor_rubber_auto_reaim'] = 'Changement d\'angle de vis�e automatique';
$str['sch_editor_rubber_auto_reaim_hint'] = 'Requiert RubberWorm31.';
$str['sch_editor_rubber_circular_aim'] = 'Vis�e 360�';
$str['sch_editor_rubber_circular_aim_hint'] = 'Oui, cette option vient de Test Stuff, mais avec Rubber Worm elle est directement sauvegard�e dans le style de partie. Requiert RubberWorm31.';
$str['sch_editor_rubber_antilock_power'] = 'Jauge qui se r�duit apr�s �tre arriv�e au maximum';
$str['sch_editor_rubber_antilock_power_hint'] = 'Une autre option TS directement sauvegard�e dans le style de partie. Requiert RubberWorm31.';
$str['sch_editor_rubber_kaosmod'] = 'Kaosmod';
$str['sch_editor_rubber_kaosmod_hint'] = 'Les kaosmod sont des sets alternatifs des probabilit�s de trouver chaque utilitaire dans une caisse. Requiert RubberWorm31.';

$str['sch_editor_rubber_crate_rate'] = 'Caisses par tour et compteur de caisses';
$str['sch_editor_rubber_crate_rate_hint'] = 'Toutes les valeurs, sauf 0, activent le compteur.';
$str['sch_editor_rubber_crate_limit'] = 'Nombre maximal de caisses';
$str['sch_editor_rubber_crate_limit_hint'] = 'S\'il y a trop de caisses, plus aucune n\'appara�tra, et ce, jusqu\'� ce que certaines caisses disparaissent (qu\'elles aient �t� collect�es, d�truites ou coul�es).';

$str['sch_editor_rubber_friction'] = 'Adh�rence';
$str['sch_editor_rubber_friction_hint'] = 'En �ditant cette option, vous changez la fa�on dont la vitesse d\'un ver qui glisse varie. 1-95: haute adh�rence, 96: adh�rence normale, 97-99: faible adh�rence, 100: pas d\'adh�rence, plus de 100: la vitesse augmente pendant la glissade, au lieu de diminuer.';
$str['sch_editor_rubber_flames_limit'] = 'Nombre maximum de flammes';
$str['sch_editor_rubber_flames_limit_hint'] = 'Peut �tre mis jusqu\'� 25 500. Requiert RubberWorm31 (pour la v3.6.31.0) ou LaserFix (pour la v3.6.29.0).';
$str['sch_editor_rubber_speed'] = 'Vitesse';
$str['sch_editor_rubber_speed_hint'] = 'Vous pouvez modifier la vitesse maximale des objets. 16: par d�faut (utile pour activer TS en gardant la vitesse par d�faut), 32: comme dans le Test Stuff actuel, 255: sans limite, comme dans TS3. Requiert RubberWorm31.';
$str['sch_editor_rubber_anti_worm_sink'] = 'Les vers ne coulent pas';
$str['sch_editor_rubber_anti_worm_sink_hint'] = 'Quand un ver coule, il sera ret�l�port� l� o� il �tait juste avant de couler. S\'il coule juste apr�s avoir �t� ret�l�port� (parce que le terrain n\'existe plus), il meurt bel et bien.';
$str['sch_editor_rubber_swat'] = 'S�lection de ver n\'importe quand pendant le tour';
$str['sch_editor_rubber_swat_hint'] = 'Si la s�lection du ver au d�but du tour est manuelle, vous pourrez changer de ver � tout moment pendant votre tour. Sinon, vous ne pourrez changer de ver qu\'une fois avoir utilis� l\'arme s�lection de ver, les effets ne durant qu\'un tour (un peu comme pour la faible pesanteur ou la marche rapide). Requiert RubberWorm31.';
$str['sch_editor_rubber_air_viscosity'] = 'Perte de vitesse dans l\'air';
$str['sch_editor_rubber_air_viscosity_hint'] = 'Ici, vous pouvez d�finir la vitesse � laquelle un objet volant perd de la vitesse. Si la valeur est impaire, alors cela s\'applique �galement aux vers.';
$str['sch_editor_rubber_wind_influence'] = 'Influence du vent sur les objets';
$str['sch_editor_rubber_wind_influence_hint'] = 'Ici, vous pouvez d�finir � quel point le vent influe sur certains objets volants. Si la valeur est impaire, alors cette influence s\'applique aussi aux vers. Une valeur de 255 fera en sorte que tous les objets (en dehors des caisses, des tombes, des barils...) et les vers soient aussi sensibles au vent qu\'un missile de Bazooka.';
$str['sch_editor_rubber_worms_bounciness'] = 'Taux de rebondissement des vers';
$str['sch_editor_rubber_worms_bounciness_hint'] = 'La valeur que vous indiquez sera divis�e par 255 pour obtenir un taux entre 0 et 1.';

$str['sch_editor_rubber_version_override'] = '�muler une ancienne version';
$str['sch_editor_rubber_version_override_hint'] = 'Vous voulez que votre scheme soit jou�e avec une version ant�rieure de la logique du jeu, pour simuler de vieux glitches ou bugs par exemple ? Aucun probl�me, s�lectionnez-la ici. N\'oubliez pas de prendre en compte les limites pos�es par la version que vous s�lectionnez : les plus vieilles versions ne supportent par exemple pas les maps PNG (surtout les grandes), ou encore les parties avec plus de 18 vers.';

$str['sch_editor_general_settings'] = 'Options g�n�rales';
$str['sch_editor_action_replays'] = 'Replays instantan�s automatiques';
$str['sch_editor_action_replays_hint'] = '[Hors-Ligne] Remontre automatiquement un tir qui a caus� beaucoup de d�g�ts.';
$str['sch_editor_blood_mode'] = 'Mode sang';
$str['sch_editor_blood_mode_hint'] = 'Si vous l\'activez, du sang appara�tra quand un ver est bless�.';
$str['sch_editor_god_mode'] = 'Mode divin';
$str['sch_editor_god_mode_hint'] = 'Si vous l\'activez, tous les vers auront une quantit� d\'�nergie infinie.';
$str['sch_editor_sheep_heaven'] = 'Paradis des moutons';
$str['sch_editor_sheep_heaven_hint'] = 'Si vous activez cette option, un mouton sortira de chaque caisse d�truite (pas seulement de celles qui contiennent un mouton ou un super mouton). Le temps de vol du super mouton est rallong�.';
$str['sch_editor_rubber_gravity_modifications'] = 'Modifications de la gravit�';
$str['sch_editor_rubber_gravity_modifications_hint'] = 'L�, vous avez pas mal de possibilit�s : vous pouvez augmenter ou diminuer la gravit� de base en effet (options "grav##"), mais pas seulement. Vous pouvez aussi inverser cette gravit� (options "grav-##"), ce qui fait que les vers marcheront au plafond (les d�placements sont difficiles cependant), ou bien encore, cr�er un trou noir. Celui-ci se trouvera au centre de la map et attirera ou repoussera tous les objets et les vers vers lui. Son attraction est soit constante (partout la m�me sur la carte, options "cbh(-)##") soit proportionnelle (plus l\'objet est loin moins l\'attraction est importante, options "pbh(-)##").';
$str['sch_editor_indestructible_landscape'] = 'Terrain indestructible';
$str['sch_editor_indestructible_landscape_hint'] = 'Si vous activez cette option, le terrain ne pourra pas �tre d�truit.';

$str['sch_editor_weapon_upgrade_settings'] = 'Am�liorations des armes';
$str['sch_editor_aqua_sheep'] = 'Mouton aquatique';
$str['sch_editor_aqua_sheep_hint'] = 'Si cette option est activ�e, le super mouton deviendra un mouton aquatique et sera capable de voyager sous l\'eau.';
$str['sch_editor_upgraded_grenade'] = 'Super grenade';
$str['sch_editor_upgraded_grenade_hint'] = 'Si cette option est activ�e, les grenades seront plus puissantes.';
$str['sch_editor_upgraded_clusters'] = 'Super armes � fragments';
$str['sch_editor_upgraded_clusters_hint'] = 'Si cette option est activ�e, les armes � fragmentation rel�chent encore plus de fragments.';
$str['sch_editor_upgraded_shotgun'] = 'Super fusil de chasse';
$str['sch_editor_upgraded_shotgun_hint'] = 'Si cette option est activ�e, le fusil de chasse tirera deux balles par tir.';
$str['sch_editor_upgraded_longbow'] = 'Super arc';
$str['sch_editor_upgraded_longbow_hint'] = 'Si cette option est activ�e, l\'arc sera plus puissant.';

$str['sch_editor_weapon_settings'] = 'Options des armes';
$str['sch_editor_double_damage'] = 'D�g�ts doubl�s au premier tour';
$str['sch_editor_double_damage_hint'] = 'Si vous activez cette option, les d�g�ts inflig�s au premier tour seront doubl�s.';
$str['sch_editor_team_weapons'] = 'Armes d\'�quipe';
$str['sch_editor_team_weapons_hint'] = 'Lors de la cr�ation d\'une �quipe, le joueur peut choisir une arme d\'�quipe parmi 8 armes propos�es. Si cette option est activ�e, chaque joueur commencera avec l\'arme qu\'il a choisie. Les options de ces 8 armes seront �cras�es.';
$str['sch_editor_super_weapons'] = 'Super armes';
$str['sch_editor_super_weapons_hint'] = 'Si vous activez cette option, les super-armes pourront appara�tre dans les caisses.';
$str['sch_editor_general_weapons_hint'] = 'Quelques trucs avant de commencer avec les armes : pour avoir une infinit� de munitions pour une arme, tapez 10 ; pour donner un d�lai infini � une arme (pour la bloquer donc), tapez 128.';
$str['sch_editor_jet_pack_power_message'] = 'Indiquez directement la quantit� de carburant (de 0 � 250; 0 voulant dire infini et 30 �tant la valeur par d�faut).';

$str['sch_editor_send'] = 'Voil�, j\'ai fini. Allons-y !';

$str['sch_editor_scheme_succesfully_created_message'] = 'Scheme cr�� avec succ�s !';
$str['sch_editor_download_scheme_message'] = 'T�l�chargez-le en cliquant sur ce lien.';

// Scheme uploader
$str['sch_editor_sch_uploader_title'] = 'Importer un scheme';
$str['sch_editor_sch_uploader_intro'] = 'Donc, votre scheme est d�j� pr�t, et tout ce que vous voudriez ce serait de pouvoir de l\'importer ici, au lieu de le recr�er? Aucun probl�me, il vous suffit simplement de remplir le formulaire ci-dessous. Le fichier que vous importez doit �tre au format *.wsc et doit �tre valide (non non, vous ne m\'aurez pas aussi facilement :O).';
$str['sch_editor_sch_uploader_sch_file'] = 'Votre fichier';
$str['sch_editor_sch_upload_button'] = 'Envoyez-nous votre �uvre d\'art ! =)';
$str['sch_editor_sch_upload_error_invalid_scheme_file'] = 'Fichier invalide. Les erreurs suivantes ont �t� trouv�es :';
$str['sch_editor_sch_upload_error_incorrect_extension'] = 'Le fichier n\'a pas la bonne extension.';
$str['sch_editor_sch_upload_error_incorrect_size'] = 'Le fichier n\'est pas de la bonne taille.';
$str['sch_editor_sch_upload_error_incorrect_signature'] = 'La signature du fichier scheme est incorrecte.';
$str['sch_editor_sch_upload_error_incorrect_size_v1'] = 'Un fichier scheme version 1 doit avoir une taille de 221 octets.';
$str['sch_editor_sch_upload_error_incorrect_size_v2'] = 'Un fichier scheme version 2 doit avoir une taille de 297 octets.';
$str['sch_editor_sch_upload_error_incorrect_version_byte'] = 'Version du scheme incorrecte.';
$str['sch_editor_sch_upload_error_unknown'] = 'Erreur inconnue.';
$str['sch_editor_scheme_succesfully_uploaded_message'] = 'Scheme import� avec succ�s !';
$str['sch_editor_sch_upload_fixes_have_been_applied'] = '<strong>Note :</strong> les corrections suivantes ont �t� apport�es :'; 

// My schemes
$str['sch_editor_my_schemes_title'] = 'Mes schemes';

// Changelog
$str['sch_editor_changelog'] = 'Historique du module';
$str['sch_editor_changelog_intro'] = 'Voici l\'historique de l\'�diteur de schemes.';
$str['sch_editor_changelog_v0_1_0_item1'] = 'Cr�ation de l\'�diteur de schemes, permettant de cr�er un scheme et de le t�l�charger aussit�t apr�s. Langues disponibles: fran�ais et anglais.';
$str['sch_editor_changelog_v0_1_1_item1'] = '[Am�lioration] Conversion de quelques zones d\'options en zones de saisie, comme sugg�r� par FFie (et avec son aide). Non termin�.';
$str['sch_editor_changelog_v0_1_1_item2'] = 'Cr�ation de cette page.';
$str['sch_editor_changelog_v0_1_2_item1'] = '[Correction de bug] Le temps de la manche est d�sormais correctement enregistr� lorsqu\'il est d�fini en secondes. En v0.1.0, la valeur �tait incorrectement enregistr�e (par exemple, si on mettait 90s, la valeur �tait enregistr�e comme 39s) ; en v0.1.1, elle �tait toujours enregistr�e en minutes.';
$str['sch_editor_changelog_v0_1_2_item2'] = '[Correction de bug] Les dates �taient toujours affich�es en fran�ais dans cet historique.';
$str['sch_editor_changelog_v0_2_0_item1'] = '[Am�lioration] R�organisation du formulaire, pour r�pondre � une suggestion de GreeN.';
$str['sch_editor_changelog_v0_2_0_item2'] = '[Am�lioration] Suggestion de FFie enti�rement appliqu�e.';
$str['sch_editor_changelog_v0_2_1_item1'] = '[Correction de bug] Certaines options (le d�lai entre les tours, le temps de retraite au sol et le temps de retraite apr�s avoir l�ch� une arme depuis la corde) �taient limit�es � 255 dans l\'�diteur alors que la vraie limite est 127. Cela est d�sormais corrig�.';
$str['sch_editor_changelog_v0_3_0_item1'] = '[Am�lioration] Il est d�sormais possible d\'importer des schemes sur le site.';

// Link to the page that allows us to select another language
$str['sch_editor_change_language'] = 'Changer de langue';
?>