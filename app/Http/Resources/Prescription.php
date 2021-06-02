<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Prescription extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            'id' => $this->id,
            'prescriptionType_id' => $this->prescriptionType_id,
            'patient_id' => $this->patient_id,
            'patient_userid' => $this->patient_userid,
            'doctor_id' => $this->doctor_id,
            'doctor_userid' => $this->doctor_userid,
            'appointment_id' => $this->appointment_id,
            'identifier' => $this->identifier,
            'chief_complains' => $this->chief_complains,
            'on_examinations' => $this->on_examinations,
            'provisional_diagnosis' => $this->provisional_diagnosis,
            'differential_diagnosis' => $this->differential_diagnosis,
            'lab_workup' => $this->lab_workup,
            'advices' => $this->advices,
            'reason' => $this->reason,
            'height' => $this->height,
            'weight' => $this->weight,
            'pulse' => $this->pulse,
            'blood_pressure' => $this->blood_pressure,
            'quantity_med' => $this->quantity_med,
            'next_visit' => $this->next_visit->format('d/m/Y'),
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
