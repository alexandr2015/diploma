<?php

namespace App\Repositories;

use App\Models\CalculatedResponse;
use App\Models\Response;

class ResponseRepository extends BaseRepository
{
    public function model()
    {
        return Response::class;
    }

    public function createResponse(array $data, $questionId)
    {
        $startTime = $data['startTime'];
        $userId = \Auth::user()->id;
        $avgResponse = [
            'now_a' => 0,
            'now_b' => 0,
            'now_c' => 0,
            'now_d' => 0,
            'future_a' => 0,
            'future_b' => 0,
            'future_c' => 0,
            'future_d' => 0,
        ];
        foreach ($data['range'] as $key => $item) {
            $nowA = (int)$item['now']['a'];
            $nowB = (int)$item['now']['b'];
            $nowC = 100 - $nowA;
            $nowD = 100 - $nowB;
            $futureA = (int)$item['future']['a'];
            $futureB = (int)$item['future']['b'];
            $futureC = 100 - $futureA;
            $futureD = 100 - $futureB;
            $savedData = [
                'student_id' => $userId,
                'now_a' => $nowA,
                'now_b' => $nowB,
                'now_c' => $nowC,
                'now_d' => $nowD,
                'future_a' => $futureA,
                'future_b' => $futureB,
                'future_c' => $futureC,
                'future_d' => $futureD,
                'question_option_id' => $key,
            ];
            $avgResponse['now_a'] += $nowA;
            $avgResponse['now_b'] += $nowB;
            $avgResponse['now_c'] += $nowC;
            $avgResponse['now_d'] += $nowD;
            $avgResponse['future_a'] += $futureA;
            $avgResponse['future_b'] += $futureB;
            $avgResponse['future_c'] += $futureC;
            $avgResponse['future_d'] += $futureD;
            $this->create($savedData); // todo add transaction
        }
        $count = count($data['range']);
        $avgResponse['now_a'] /= $count;
        $avgResponse['now_b'] /= $count;
        $avgResponse['now_c'] /= $count;
        $avgResponse['now_d'] /= $count;
        $avgResponse['future_a'] /= $count;
        $avgResponse['future_b'] /= $count;
        $avgResponse['future_c'] /= $count;
        $avgResponse['future_d'] /= $count;
        $avgResponse['duration'] = time() - $startTime;
        $avgResponse['user_id'] = $userId;
        $avgResponse['question_id'] = $questionId;

        CalculatedResponse::create($avgResponse);
        return true;
    }
}