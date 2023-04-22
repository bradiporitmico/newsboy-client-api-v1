<?php

namespace Newsboy\Client\v1;
 
class AdOptions {

	const AUCTION = 'auction'; // asta
	const LIFT = 'lift';				// ascensore

	const BUILDABLE = 'buildable';				// edificabile

	const NAME_HIDDEN = 'name.hidden';	// il nome dell'inserzionista deve essere nascosto
	const ADDRESS_HIDDEN = 'address.hidden';	// l'indirizzo deve essere nascosto
	const ADDRESS_NUMBER_HIDDEN = 'address.number.hidden';	// il numero civico dell'indirizzo deve essere nascosto
	const PHONE_HIDDEN = 'phone.hidden';	// il numero di telefono deve essere nascosto
	const POSITION_HIDDEN = 'position.hidden';	// la posizione lat/long deve essere nascosta
	const PRICE_HIDDEN = 'price.hidden';	// il prezzo deve essere nascosto
	
	
	const POSITION_NOT_ACCURATE = 'position.not-accurate';	// la posizione lat/long non è accurata ma calcolata in base al comune
	
	const DRIVEWAY = 'driveway';	// presenza di passo carrabile

	const LUXURY = 'luxury';	// immobile di lusso
	const GRANDLUXURY = 'grandluxury';	// immobile di gran lusso
	const PRESTIGIOUS = 'prestigious';	// di prestigio
	const HISTORIC = 'historic';				// residenza storica
	
	const GUARDIAN = 'guardian';				// guardiano
	const CARETAKER_HOUSE = 'caretaker-house';				// casa del custode
	const IRRIGATION_SYSTEM = 'irrigation-system';				// sistema di irrigazione

	const BARE_OWNERSHIP = 'bare-ownership';	// nuda proprietà

	const FURNISHED = 'furnished';	// arredata
	const FURNISHED_NOT = 'furnished.not';	// non arredato
	const PARTIALLY_FURNISHED = 'furnished.partially';	// parzialmente arredata
	const PARTIALLY_FURNISHED_KITCHEN = 'furnished.partially.kitchen';	// parzialmente arredata di cucina
	const FULL_FURNISHED = 'furnished.fully';	// completamente arredata
	const FURNISHED_KITCHEN = 'furnished.kitchen';	// arredata solo di cucina
	const FURNISHED_BEDLINEN = 'furnished.bedlinen';	// biancheria da letto

	const HEATING_SYSTEM = 'heating';	// sistema di riscaldamento presente
	const HEATING_AUTONOMOUS = 'heating.autonomous';	// riscaldamento autonomo
	const HEATING_REDO = 'heating.redo';	// sistema di riscaldamento da rifare
	const HEATING_TODO = 'heating.todo';	// sistema di riscaldamento da fare
	const HEATING_NONE = 'heating.none';	// riscaldamento assente
	const HEATING_CENTRAL = 'heating.central';	// riscaldamento centralizzato
	const HEATING_NETWORK = 'heating.network';	// teleriscaldamento
	const HEATING_TYPE_ELECTRIC = 'heating.type.electric';	// sistema di riscaldamento elettrico
	const HEATING_TYPE_BOILER = 'heating.type.boiler';	// sistema di riscaldamento a caldaia
	const HEATING_TYPE_CONDENSING_BOILER = 'heating.type.condensing.boiler';	// sistema di riscaldamento a caldaia a condensazione
	const HEATING_TYPE_GAS = 'heating.type.gas';	// sistema di riscaldamento a gas
	const HEATING_TYPE_METHANE = 'heating.type.methane';	// sistema di riscaldamento a metano
	const HEATING_TYPE_HEAT_PUMP = 'heating.type.heat-pump';	// sistema di riscaldamento a pompa di calore
	const HEATING_TYPE_LPG = 'heating.type.lpg';	// sistema di riscaldamento a GPL
	const HEATING_TYPE_DIESEL = 'heating.type.diesel';	// sistema di riscaldamento a gasolio
	const HEATING_TYPE_WOOD = 'heating.type.wood';	// sistema di riscaldamento a legna
	const HEATING_TYPE_PELLETS = 'heating.type.pellets';	// sistema di riscaldamento a pellets
	const HEATING_TYPE_GEOTHERMAL = 'heating.type.geothermal';	// sistema di riscaldamento a impianto geotermico
	const HEATING_TYPE_WIND = 'heating.type.wind';	// sistema di riscaldamento eolico
	const HEATING_TYPE_HYDROELECTRIC = 'heating.type.hydroelectric';	// sistema di riscaldamento idroelettrico
	const HEATING_TYPE_BIOMASS = 'heating.type.biomass';	// sistema di riscaldamento a biomassa
	const HEATING_TYPE_MULTI = 'heating.type.multi';	// sistema di riscaldamento multicombustibile
	const HEATING_TYPE_NUCLEAR = 'heating.type.nuclear';	// sistema di riscaldamento nucleare
	const HEATING_CYLINDER = 'heating.type.cylinder';	// sistema di riscaldamento con bombolone esterno
	const HEATING_STOVE = 'heating.stove';	// riscaldamento a stufa
	const HEATING_COAL = 'heating.type.coal';		// sistema di riscaldamento a carbone
	const HEATING_WATER = 'heating.type.water';		// sistema di riscaldamento ad acqua calda
	const SOLAR_THERMAL = 'heating.type.solar-thermal';	// solare termico
	const AIR_CONDITIONER = 'air-conditioner';	// aria condizionata
	const AIR_CONDITIONER_ENABLED = 'air-conditioner.enabled';	// predisposizione per impianto aria condizionata

	const HEATING_UNDERFLOOR = 'heating.underfloor';	// riscaldamento a pavimento
	const HEATING_RADIATOR = 'heating.radiator';	// riscaldamento con radiatori
	const HEATING_RADIATOR_ALUMINUM = 'heating.radiator.aluminum';	// riscaldamento con radiatori in alluminio
	const HEATING_RADIATOR_CAST_IRON = 'heating.radiator.cast-iron';	// riscaldamento con radiatori in ghisa
	const HEATING_RADIATOR_STEEL = 'heating.radiator.steel';	// riscaldamento con radiatori in acciaio
	const HEATING_TYPE_RADIANT_PANELS = 'heating.type.radiant-panels';	// sistema di riscaldamento a pannelli radianti
	const AIR_HEATING = 'heating.air';	// riscaldamento a termoconvettore

	const ENERGY_CERTIFICATION_FREE = 'energy.certification-free';	// esente da certificazione energetica
	const ENERGY_ZERO_CONSUMPTION = 'energy.zero-consumption';	// consumo "quasi" zero
	const PHOTOVOLTAIC = 'energy.photovoltaic';	// impianto pannelli fotovoltaico

	const APPLIANCE_DISHWASHER = 'appliance.dishwasher';	// lavastoviglie
	const APPLIANCE_WASHING_MACHINE = 'appliance.washing-machine';	// lavatrice
	const APPLIANCE_OVEN = 'appliance.oven';	// forno
	const APPLIANCE_OVEN_MICROWAVE = 'appliance.oven-microwave';	// forno microonde
	const APPLIANCE_STEREO = 'appliance.stereo';	// impianto stereo
	const APPLIANCE_TV = 'appliance.tv';	// televisione presente
	const APPLIANCE_TV_DISH = 'appliance.tv-dish';	// parabola
	const APPLIANCE_FRIDGE = 'appliance.fridge';	// frigorifero
	const APPLIANCE_SHOWER = 'appliance.shower';	// doccia
	const APPLIANCE_BATHTUB = 'appliance.bathtub';	// vasca da bagno
	const APPLIANCE_SHAREDBATH = 'appliance.sharedbath';	// bagno condiviso
	const APPLIANCE_PRIVATEBATH = 'appliance.privatebath';	// bagno privato
	const APPLIANCE_JACUZZI = 'appliance.jacuzzi';	// vasca jacuzzi
	const APPLIANCE_IRON = 'appliance.iron';	// ferro da stiro
	const APPLIANCE_HAIRDRYER = 'appliance.hairdryer';	// asciugacapelli
	const APPLIANCE_DRYER = 'appliance.dryer';	// asciugatrice
	const APPLIANCE_PHONE = 'appliance.phone';	// telefono
	const APPLIANCE_COFFIEMACHINE = 'appliance.coffiemachine';	// macchina del caffè
	const APPLIANCE_FREEZER = 'appliance.freezer';	// congelatore
	const APPLIANCE_DESK = 'appliance.desk';	// tavolo / scrittoio

	const WATERWASTE_SEPTICTANK = 'waterwaste.septictank';	// Scarico in fossa bilogica
	const WATERWASTE_SEWER = 'waterwaste.sewer';	// scarico in fognatura
	const WATERWASTE_PURIFICATION = 'waterwaste.purification';	// scarico in impianto di depurazione
	
	const LUXURY_SPA = 'luxury.spa';	// centro benessere
	const LUXURY_TURKISH_BATH = 'luxury.turkish-bath';	// bagno turco
	const LUXURY_WOODS = 'luxury.woods';	// bosco di proprietà
	const LUXURY_CLUBHOUSE = 'luxury.clubhouse';	// clubhouse
	const LUXURY_DOCK = 'luxury.dock';	// darsena / molo
	const LUXURY_GOLF = 'luxury.golf';	// campo da golf
	const LUXURY_FITNESS = 'luxury.fitness';	// locale fitness
	const LUXURY_STABLES = 'luxury.stables';	// maneggio
	const LUXURY_PARK = 'luxury.park';	// parco
	const LUXURY_SAUNA = 'luxury.sauna';	// sauna
	const LUXURY_TENNIS = 'luxury.tennis';	// campo da tennis
	const LUXURY_SQUASH = 'luxury.squash';	// campo da squash
	const LUXURY_TOWER = 'luxury.tower';	// torre
	const LUXURY_RELAX = 'luxury.relax';	// zona di relax
	const LUXURY_BEACH = 'luxury.beach';	// posto spiaggia
	const LUXURY_SOCCER = 'luxury.soccer';	// campo da calcio
	const LUXURY_BASKET = 'luxury.basket';	// campo da basket
	const LUXURY_GYM = 'luxury.gym';	// palestra
	
	const MAINTENANCE_TOBE = 'maintenance.tobe';	// da ristrutturare
	const MAINTENANCE_OK = 'maintenance.ok';	// ristrutturato
	const MAINTENANCE_DECENT = 'maintenance.decent';	// stato di manutenzione discreto
	const MAINTENANCE_RENOVATING = 'maintenance.renovating';	// stato di manutenzione in ristrutturazione
	const MAINTENANCE_RAW = 'maintenance.raw';	// stato di manutenzione al grezzo
	const MAINTENANCE_GOOD = 'maintenance.good';	// stato di manutenzione buono
	const MAINTENANCE_OPTIMAL = 'maintenance.optimal';	// stato di manutenzione ottimo
	const MAINTENANCE_NEW = 'maintenance.new';	// stato di manutenzione nuovo
	const MAINTENANCE_RUIN = 'maintenance.ruin';	// stato di manutenzione: rudere
	const MAINTENANCE_INSTALLATION_NONE = 'maintenance.installation.none';	// impianti da fare
	const MAINTENANCE_INSTALLATION_TOBE = 'maintenance.installation.tobe';	// impianti da rifare
	const MAINTENANCE_INSTALLATION_OK = 'maintenance.installation.ok';	// impianti a norma

	const ALARM = 'alarm';	// sistema di allarme
	const ALARM_ENABLED = 'alarm.enabled';	// predisposizione al sistema di allarme
	const POOL = 'pool';	// piscina
	const SOLARIUM = 'solarium';	// solarium
	const HYDROMASSAGE = 'hydromassage';	// idromassaggio
	const TENNIS = 'tennis';	// campo da tennis
	const KEYS_OFFICE = 'keys.office';	// chiavi in ufficio
	const KEYS_AGENCY = 'keys.agency';	// chiavi in agenzia
	const KEYS_DOORMAN = 'keys.doorman';	// chiavi dal portinaio
	const SAFE = 'safe';	// cassaforte
	const DOUBLE_GLASSES = 'glasses.double';	// doppio vetro
	const TRIPLE_GLASSES = 'glasses.triple';	// triplo vetro
	const FIREPLACE = 'fireplace';	// camino
	const HOME_AUTOMATION = 'home-automation';	// domotica
	const SATELLITE = 'satellite';	// impianto satellitare
	const MOSQUITO_NET = 'mosquito-net';	// zanzariere
	const HELIPORT = 'heliport';	// eliporto
	const ARTESIAN_WELL = 'artesian-well';	// pozzo artesiano

	const AISLE = 'aisle';	// corridoio
	const DISIMPEGNO = 'disimpegno';	// disimpegno

	const STORAGE = 'storage';	// deposito
	const STORAGE_BICYCLE = 'storage.bicycle';	// deposito bici
	const STORAGE_SKI = 'storage.ski';	// deposito sci

	const OVEN_BBQ = 'oven.bbq';	// forno barbecue
	
	const BARN = 'barn';	// fienile

	const SECURITY_DOOR = 'security.door';	// porta blindata
	const SECURITY_SERVICE = 'security.service';	// servizio di sicurezza
	const SECURITY_FIRE_SYSTEM = 'security.fire-sysytem';	// impianto di antincendio
	const VIDEO_SURVEILLANCE = 'security.video-surveillance';	// video sorveglianza
	const ANTITHEFT = 'security.antitheft';	// antifurto

	const VIDEO_INTERCOM = 'video-intercom';	// videocitofono
	const INTERCOM = 'intercom';	// citofono
	
	const NETWORK_INTERNET = 'network.internet';	// accesso ad internet
	const NETWORK_LAN = 'network.lan';	// rete LAN
	const NETWORK_OPTIC_FIBER = 'network.fiber';	// rete locale in fibra ottica
	const NETWORK_WIFI = 'network.wifi';	// rete wifi
	const NETWORK_ADSL = 'network.adsl';	// adsl
	
	const THERMAL_COAT = 'thermal-coat';	// cappotto termico
	const RAILINGS = 'railings';	// inferriate

	const FIXTURES_ALUMINUM = 'fixtures.aluminun';	// infissi alluminio
	const FIXTURES_WOOD = 'fixtures.wood';	// infissi legno
	const FIXTURES_NEW = 'fixtures.new';	// infissi nuovi
	const FIXTURES_EXCELLENT = 'fixtures.excellent';	// infissi in ottimo stato
	const FIXTURES_FAIRCONDITION = 'fixtures.faircondition';	// infissi in discreto stato
	const FIXTURES_POORCONDITION = 'fixtures.poorcondition';	// infissi in mediocre stato
	const FIXTURES_GOOD = 'fixtures.good';	// infissi in buono stato
	const FIXTURES_REPLACE = 'fixtures.replace';	// infissi da sostituire
	const FIXTURES_NONE = 'fixtures.none';	// infissi assenti
	const FIXTURES_PVC = 'fixtures.pvc';	// infissi in PVC
	const FIXTURES_IRON = 'fixtures.iron';	// infissi in ferro
	const FIXTURES_THERMAL_BREAK = 'fixtures.thermal-break';	// infissi a taglio termico
	const FIXTURES_DOUBLE_GLAZING = 'fixtures.double-glazing';	// infissi in vetrocamera
	const FIXTURES_VALUABLE = 'fixtures.valuable';	// infissi di pregio

	const KITCHEN = 'kitchen';	// cucina presente
	const KITCHEN_NONE = 'kitchen.none';	// cucina assente
	const KITCHEN_FULL = 'kitchen.full';	// cucina abitabile
	const KITCHENETTE = 'kitchen.kitchenette';	// angolo cottura (a vista su un locale)
	const KITCHEN_SMALL = 'kitchen.small';	// cucinotto (piccolo e separato)
	const KITCHEN_SEMI = 'kitchen.semi';	// cucina semiabitabile
	const KITCHEN_FOODCOOK = 'kitchen.foodcook';	// cuocivivande
	const KITCHEN_OPEN = 'kitchen.open';	// a vista

	const ATTIC = 'attic';	// soffitta / mansarda
	const MEZZANINE = 'mezzanine';	// soppalco
	const STUDY = 'study';	// studio
	const CELLAR = 'cellar';	// cantina
	const ELETRIC_GATE = 'eletric-gate';	// cancello elettrico
	const PORCH = 'porch';	// porticato / veranda
	const TAVERN = 'tavern';	// taverna
	const CLOSET = 'closet';	// ripostiglio
	const WALK_IN_CLOSET = 'walk-in-closet';	// cabina armadio
	const TOOL_SHED = 'tool-shed';	// casetta attrezzi
	
	const ELECTRIC_SYSTEM = 'electric-system';	// impianto elettrico presente e a norma
	const ELECTRIC_SYSTEM_REDO = 'electric-system.redo';	// impianto elettrico da rifare
	const ELECTRIC_SYSTEM_VERIFY = 'electric-system.verify';	// impianto elettrico da verificare
	const ELECTRIC_SYSTEM_NEW = 'electric-system.new';	// impianto elettrico nuovo
	const ELECTRIC_SYSTEM_ORIGINAL = 'electric-system.original';	// impianto elettrico originale

	const HYDRAULIC_SYSTEM = 'hydraulic-system';	// impianto idraulico a norma
	const HYDRAULIC_SYSTEM_REDO = 'hydraulic-system.redo';	// impianto idraulico da rifare
	const HYDRAULIC_SYSTEM_VERIFY = 'hydraulic-system.verify';	// impianto idraulico da verificare
	const HYDRAULIC_SYSTEM_NEW = 'hydraulic-system.new';	// impianto idraulico nuovo
	const HYDRAULIC_SYSTEM_ORIGINAL = 'hydraulic-system.original';	// impianto idraulico originale

	const LIVING = 'living';	// zona giorno
	const LIVING_ROOM = 'living.room';	// zona giorno sala
	const LIVING_LOUNGE = 'living.lounge';	// zona giorno salone
	const LIVING_SITTING_ROOM = 'living.sitting-room';	// zona giorno salotto
	const LIVING_DINETTE = 'living.dinette';	// zona giorno tinello

	const GARDEN = 'garden';	// giardino
	const COMMUNAL_GARDEN = 'garden.communal';	// giardino comunale
	const GARDEN_COMMUNAL = 'garden.communal';	// giardino comunale
	const PRIVATE_GARDEN = 'garden.private';	// giardino privato
	const GARDEN_PRIVATE = 'garden.private';	// giardino privato
	const GARDEN_LAND = 'garden.land';	// giardino terreno
	const GARDEN_NONE = 'garden.none';	// giardino non presente

	const COURTYARD = 'courtyard';	// cortile esterno disponibile
	const COURTYARD_PUBLIC = 'courtyard.public';	// cortile pubblico (in comune)
	const COURTYARD_PRIVATE = 'courtyard.private';	// cortile privato 
	
	const CONCIERGE = 'concierge';	// portineria disponibile

	const INDEPENDENT_ENTRANCE = 'entrance.independent';	// ingresso indipendente

	const BERTH = 'berth';	// posto barca

	const PARKING = 'parking';	// posto auto
	const PARKING_CUSTOM = 'parking.custom';	// posto auto customizzato (leggere il campo 'parking_description')
	const PARKING_PRIVATE = 'parking.private';	// posto auto privato
	const PARKING_DOUBLE = 'parking.double';	// posto auto doppio
	const PARKING_TRIPLE = 'parking.triple';	// posto auto triplo
	const PARKING_COVERED = 'parking.covered';	// posto auto coperto
	const PARKING_CONDOMINIUM = 'parking.condominium';	// posto auto condominiale
	const PARKING_UNAVAILABLE = 'parking.unavailable';	// posto auto non presente
	const PARKING_UNCOVERED = 'parking.uncovered';	// posto auto scoperto
	const PARKING_STREET = 'parking.street';	// posto auto in strada pubblica
	const PARKING_INDOOR = 'parking.indoor';	// posto auto all'interno dell'immobile
	const PARKING_NONE = 'parking.none';	// posto auto assente
	const GARAGE = 'garage';	// garage
	const GARAGE_NONE = 'garage.none';	// garage assente
	const DOUBLE_GARAGE = 'garage.double';	// doppio garage
	const GARAGE_TRIPLE = 'garage.triple';	// triplo garage
	const GARAGE_QUADRUPLE = 'garage.quadruple';	// quadruplo garage
	const GARAGE_DEPOT = 'garage.depot';	// garage / rimessa
	const GARAGE_OPTIONAL = 'garage.optional';	// garage opzionale

	const LAUNDRY = 'laundry';	// lavanderia
	const BOILER_ROOM = 'boiler-room';	// locale caldaia

	const LOCATION_SEA = 'location.sea';	// al mare
	const LOCATION_MOUNTAINS = 'location.mountains';	// in montagna
	const LOCATION_LAKE = 'location.lake';	// al lago
	const LOCATION_HOT_SPRING = 'location.hot-spring';	// alle terme
	const LOCATION_HILLS = 'location.hills';	// in collina
	const LOCATION_COUNTRY = 'location.country';	// in campagna

	const USE_HOLIDAY = 'use.holiday';	// ad uso vacanza
	const USE_INVESTMENT = 'use.investment';	// adatto per investimento

	const NEW = 'new';	// nuova costruzione
	const RAW = 'raw';	// grezzo
	const ANIMALS = 'animals';	// animali permessi
	const SMOKING = 'smoking';	// fumatori permessi
	const PRIVATE_NEGOTIATION = 'private-negotiation';	// trattativa riservata
	const PRICE_PRIVATE_NOGOTIATION = 'price.private-negotiation';	// prezzo trattative riservate

	const PRICE_FROM = 'price.from';	// a partire da
	const PRICE_NEGOTIABLE = 'price.negotiable';	// prezzo trattabile
	const PRICE_AGENCY = 'price.agency';	// prezzo informazioni in agenzia

	const AUCTIONED = 'auctioned';	// sottoposto ad asta

	const INCLUDE_OFFICE = 'include.office';	// include uffici
	const INCLUDE_LOCKER_ROOM = 'include.locker-room';	// include spogliatoi
	const INCLUDE_RESTAURANT = 'include.restaurant';	// include ristorante


	const FOR_STUDENTS = 'for-students';	// adatto per studenti
	const ARCHITECTURAL_BARRIERS = 'architectural-barriers';	// barriere architettoniche
	const AVAILABLE_IMMEDIATELY = 'available-immediately';	// disbonibile da subito
	const BALCONY = 'balcony';	// balcone disponibile
	const TERRACES = 'terraces';	// terrazzo disponibile
	const TERRACES_PUBLIC = 'terraces.public';	// terrazzo in comune
	const TERRACES_PRIVATE = 'terraces.private';	// terrazzo privato
	
	const DISABLED_ACCESS = 'disabled-access';	// accesso per disabili

}
