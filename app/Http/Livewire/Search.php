<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Twitter;

class Search extends Component
{
    // Variaveis Publicas
    public $search = '';

    public $agree = 0;
    public $disagree = 0;
    public $neutral = 0;

    public $perc_agree = 0;
    public $perc_neutral = 0;
    public $perc_disagree = 0;

    // validação de campo de Pesquisa
    protected $rules = [
        'search' => 'required|min:4',
    ];

    // Render View
    public function render()
    {
        return view('livewire.search')
            ->extends('layouts.app')
            ->section('content');
    }

    // Função para verificar sentimentos
    public function search_sentiments()
    {
        $this->validate();
        
        $search = $this->search;

        // Buscar Tweets
        try
        {
            // chamada api twitter, para buscar 100 tweets.
            $response_tweets = Twitter::getSearch(['count' => 100, 'format' => 'array', 'q' => $search]);
            // criação de Array de tweets
            foreach ($response_tweets['statuses'] as $tweet){
                $array_tweets['documents'][] = [
                    'id' => $tweet['id'],
                    'text' => $tweet['text'],
                ];
            }
        }
        catch (Exception $e)
        {
            dd(Twitter::logs());
        }

        try
        {
            // Api de verificação de Sentimentos das palavras
            $response = Http::withHeaders([
                'Ocp-Apim-Subscription-Key' => '9c0645ef4d3c432d8b617caeaefe1290',
                'Content-Type' => 'text/json'
            ])->post('https://eastus.api.cognitive.microsoft.com/text/analytics/v2.1/sentiment', $array_tweets)->json();
            
            // Validação de sentimentos
            if(!$response['errors']){
                foreach($response['documents'] as $result){
                    if($result['score'] >= 0.6){
                        $this->agree++;
                    }elseif($result['score'] <= 0.45){
                        $this->disagree++;
                    }else{
                        $this->neutral++;
                    }
                }  
            }
        }
        catch (Exception $e){
            dd($response['errors']);
        }

        // Calculo de porcentagem de sentimentos
        $total = $this->agree + $this->disagree + $this->neutral;

        $this->perc_agree = number_format(($this->agree / $total) * 100,2,',','.');
        $this->perc_neutral = number_format(($this->neutral / $total) * 100,2,',','.');
        $this->perc_disagree = number_format(($this->disagree / $total) * 100,2,',','.');
        
    }


}
