<?php

trait ValidatorTrait
{
    public function validateCreate(string $endpoint, array $data)
    {
        switch ($endpoint) {
            case EndpointsList::RESERVATIONS:
            case EndpointsList::RESERVATION:
                return $this->reservationValidate($data);

            default:
                return [];
        }
    }

    public function validateUpdate(string $endpoint, array $data)
    {
        switch ($endpoint) {
            case EndpointsList::RESERVATIONS:
            case EndpointsList::RESERVATION:
                return $this->reservationUpdateValidate($data);

            default:
                return [];
        }
    }

    private function reservationValidate(array $data)
    {
        $required = [
            'listing_id',
            'start_date',
            'end_date',
            'guests',
            'name',
            'email',
            'phone',
            'total_price',
            'note',
            'source',
        ];

        $optionals = [
            'status',
            'security_price',
            'tax_amount',
            'channel_commission',
            'payout_price',
            'skip_restrictions'
        ];

        $messages = [];
        foreach ($required as $key) {
            if (!isset($data[$key])) {
                $messages[] = $key . ' field is required';
            }
        }

        if (isset($data['status'])) {
            if (!in_array($data['status'], ['accepted', 'pending'])) {
                $messages[] = 'Field status has incorrect data';
            }
        }
        if (isset($data['skip_restrictions'])) {
            if (!in_array($data['skip_restrictions'], [true, false, 0, 1, 'true', 'false'])) {
                $messages[] = 'Field skip_restrictions has incorrect data';
            }
        }

        return $messages;
    }

    private function reservationUpdateValidate(array $data)
    {
        $required = [
            'listing_id',
            'status',
            'check_in',
            'check_out',
            'planned_arrival',
            'planned_departure',
        ];

        $messages = [];
        foreach ($required as $key) {
            if (!isset($data[$key])) {
                $messages[] = $key . ' field is required';
            }
        }

        if (isset($data['status'])) {
            if (!in_array($data['status'], ['accepted', 'denied', 'cancelled_by_host', 'cancelled_by_guest', 'no_show'])) {
                $messages[] = 'Field status has incorrect data';
            }
        }

        return $messages;
    }
}
