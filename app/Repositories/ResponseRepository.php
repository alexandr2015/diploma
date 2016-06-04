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
        $savedData = $this->parseData($data['range'], $userId);
        foreach ($savedData as $item) {
            unset($item['id']);
            $this->create($item);
        }
        $avgResponse = $this->avgResponse($savedData, count($savedData));
        $avgResponse['user_id'] = $userId;
        $avgResponse['question_id'] = $questionId;
        $avgResponse['duration'] = time() - $startTime;
        CalculatedResponse::create($avgResponse);

        return true;
    }

    public function avgResponse($data, $count)
    {
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

        foreach ($data as $item) {
            $avgResponse['now_a'] += $item['now_a'];
            $avgResponse['now_b'] += $item['now_b'];
            $avgResponse['now_c'] += $item['now_c'];
            $avgResponse['now_d'] += $item['now_d'];
            $avgResponse['future_a'] += $item['future_a'];
            $avgResponse['future_b'] += $item['future_b'];
            $avgResponse['future_c'] += $item['future_c'];
            $avgResponse['future_d'] += $item['future_d'];
        }
        $avgResponse['now_a'] /= $count;
        $avgResponse['now_b'] /= $count;
        $avgResponse['now_c'] /= $count;
        $avgResponse['now_d'] /= $count;
        $avgResponse['future_a'] /= $count;
        $avgResponse['future_b'] /= $count;
        $avgResponse['future_c'] /= $count;
        $avgResponse['future_d'] /= $count;

        return $avgResponse;

    }

    public function parseData($data, $userId)
    {
        $savedData = [];
        foreach ($data as $key => $item) {
            $nowA = (int)$item['now']['a'];
            $nowB = (int)$item['now']['b'];
            $nowC = 100 - $nowA;
            $nowD = 100 - $nowB;
            $futureA = (int)$item['future']['a'];
            $futureB = (int)$item['future']['b'];
            $futureC = 100 - $futureA;
            $futureD = 100 - $futureB;
            $savedData[] = [
                'user_id' => $userId,
                'now_a' => $nowA,
                'now_b' => $nowB,
                'now_c' => $nowC,
                'now_d' => $nowD,
                'future_a' => $futureA,
                'future_b' => $futureB,
                'future_c' => $futureC,
                'future_d' => $futureD,
                'question_option_id' => $key,
                'id' => (isset($item['id'])) ? $item['id'] : false,
            ];
        }

        return $savedData;
    }

    public function updateResponse(array $data, $questionId)
    {
        $startTime = $data['startTime'];
        $userId = \Auth::user()->id;
        $savedData = $this->parseData($data['range'], $userId);
        $avgResponse = $this->avgResponse($savedData, count($savedData));

        $calculatedResponse = CalculatedResponse::where('question_id', $questionId)->where('user_id', $userId)->first();
        $calculatedResponse->duration += (time() - $startTime);
        $calculatedResponse->fill($avgResponse);
        $calculatedResponse->save();

        foreach ($savedData as $item) {
            if (false !== $item['id']) {
                $id = $item['id'];
                unset($item['id']);
                $this->update($item, $id);
            } else {
                unset($item['id']);
                $this->create($item);
            }
        }

        return true;
    }
}