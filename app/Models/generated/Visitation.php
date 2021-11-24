<?php

namespace App\Models\generated;

use App\Models\BaseModel;

/**
 * @property integer $id
 * @property integer $company_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $uuid
 * @property string $status
 * @property string $to_be_scheduled_at
 * @property string $scheduled_at
 * @property string $cancel_at
 * @property string $cancel_reason
 * @property string $scheduled_start_at
 * @property string $scheduled_end_at
 * @property string $start_at
 * @property string $end_at
 * @property string $report_at
 * @property string $possible_start_1_at
 * @property string $possible_end_1_at
 * @property string $possible_start_2_at
 * @property string $possible_end_2_at
 * @property string $possible_start_3_at
 * @property string $possible_end_3_at
 * @property int $hour
 * @property string $start_point
 * @property string $start_point_url
 * @property string $start_point_image
 * @property string $main_point
 * @property string $main_point_url
 * @property string $main_point_image
 * @property string $end_point
 * @property string $end_point_url
 * @property string $end_point_image
 * @property string $information
 * @property string $mediation_condition
 * @property string $desire_condition
 * @property boolean $comply
 * @property string $comply_description
 * @property string $report_description
 * @property string $report_image_1
 * @property string $report_image_2
 * @property string $report_image_3
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Family $family
 */
class Visitation extends BaseModel
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['company_id', 'created_by', 'updated_by', 'uuid', 'status', 'to_be_scheduled_at', 'scheduled_at', 'cancel_at', 'cancel_reason', 'scheduled_start_at', 'scheduled_end_at', 'start_at', 'end_at', 'report_at', 'possible_start_1_at', 'possible_end_1_at', 'possible_start_2_at', 'possible_end_2_at', 'possible_start_3_at', 'possible_end_3_at', 'hour', 'start_point', 'start_point_url', 'start_point_image', 'main_point', 'main_point_url', 'main_point_image', 'end_point', 'end_point_url', 'end_point_image', 'information', 'mediation_condition', 'desire_condition', 'comply', 'comply_description', 'report_description', 'report_image_1', 'report_image_2', 'report_image_3', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function family()
    {
        return $this->belongsTo('App\Models\Family');
    }
}
