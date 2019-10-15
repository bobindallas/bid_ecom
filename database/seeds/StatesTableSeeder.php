<?php

use Illuminate\Database\Seeder;
use App\Model\Country;
use App\Model\State;

class StatesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

		 $states = [
			["Alabama","AL"],
			["Alaska","AK"],
			["Arizona","AZ"],
			["Arkansas","AR"],
			["California","CA"],
			["Colorado","CO"],
			["Connecticut","CT"],
			["Delaware","DE"],
			["District of Columbia","DC"],
			["Florida","FL"],
			["Georgia","GA"],
			["Hawaii","HI"],
			["Idaho","ID"],
			["Illinois","IL"],
			["Indiana","IN"],
			["Iowa","IA"],
			["Kansas","KS"],
			["Kentucky","KY"],
			["Louisiana","LA"],
			["Maine","ME"],
			["Montana","MT"],
			["Nebraska","NE"],
			["Nevada","NV"],
			["New Hampshire","NH"],
			["New Jersey","NJ"],
			["New Mexico","NM"],
			["New York","NY"],
			["North Carolina","NC"],
			["North Dakota","ND"],
			["Ohio","OH"],
			["Oklahoma","OK"],
			["Oregon","OR"],
			["Maryland","MD"],
			["Massachusetts","MA"],
			["Michigan","MI"],
			["Minnesota","MN"],
			["Mississippi","MS"],
			["Missouri","MO"],
			["Pennsylvania","PA"],
			["Rhode Island","RI"],
			["South Carolina","SC"],
			["South Dakota","SD"],
			["Tennessee","TN"],
			["Texas","TX"],
			["Utah","UT"],
			["Vermont","VT"],
			["Virginia","VA"],
			["Washington","WA"],
			["West Virginia","WV"],
			["Wisconsin","WI"],
			["Wyoming","WY"],
	 ];

		// this is US only right now
		$us = Country::where('code','US')->first();

		foreach ($states as $state) {

			$stateOb = new State();
			$stateOb->country_id = $us->id;
			$stateOb->code       = $state[1];
			$stateOb->name       = $state[0];
			$stateOb->active     = 1;
			$stateOb->save();
		}

   } // run

} // class
