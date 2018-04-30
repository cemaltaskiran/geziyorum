<?php

use Illuminate\Database\Seeder;
use App\Trip;

class TripTableSeeder extends Seeder
{
    private function seoURL($string, $wordLimit = 0){
        $separator = '-';
        
        if($wordLimit != 0){
            $wordArr = explode(' ', $string);
            $string = implode(' ', array_slice($wordArr, 0, $wordLimit));
        }
    
        $quoteSeparator = preg_quote($separator, '#');
    
        $trans = array(
            '&.+?;'                    => '',
            '[^\w\d _-]'            => '',
            '\s+'                    => $separator,
            '('.$quoteSeparator.')+'=> $separator
        );
    
        $string = strip_tags($string);
        foreach ($trans as $key => $val){
            $string = preg_replace('#'.$key.'#iu', $val, $string);
        }
    
        $string = strtolower($string);
    
        return trim(trim($string, $separator));
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $trip = new Trip();
        $trip->name = 'Demo Trip';
        $trip->user_id = 1;
        $trip->about = 'Lorem ipsum dolor sit amet, sea id solum vidisse appetere, vis aeque neglegentur et. Mei habeo vitae fabulas ea, cu paulo praesent cotidieque eos. Clita commodo ullamcorper nec te, eum eros admodum te. Cu aliquam interesset eos, eu diceret deleniti vel. Ei duo homero elaboraret, at eum dicam accusata suavitate. Ut nostrud saperet appetere pro, probo argumentum contentiones et his. His simul omnes persius et, inani facilisi ut usu. Ut eam delicata scripserit, erant debitis luptatum duo at. Ei ullum accusata sadipscing quo.';
        $trip->total_distance = 121;
        $trip->average_speed = 25;
        $trip->total_time = 11;
        $trip->media_id = 2;
        $trip->save();

        $trip->url = $this->seoURL($trip->name).'-'.$trip->id;
        $trip->save();
    }
}
