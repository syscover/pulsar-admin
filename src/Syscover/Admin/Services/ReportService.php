<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Exports\ExportCollection;
use Syscover\Core\Services\Service;
use Syscover\Core\Exceptions\ModelNotChangeException;
use Syscover\Admin\Models\Report;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;


class ReportService extends Service
{
    public function store(array $data)
    {
        $this->validate($data, [
            'subject'       => 'required|between:2,255',
            'emails'        => 'required|array',
            'profiles'      => 'required|array',
            'filename'      => 'required|between:2,255',
            'extension'     => 'required|between:2,255',
            'frequency_id'  => 'required|integer',
            'sql'           => 'required',
        ]);

        return Report::create($data);
    }

    public function update(array $data, int $id)
    {
        $this->validate($data, [
            'id'            => 'numeric',
            'subject'       => 'required|between:2,255',
            'emails'        => 'required|array',
            'profiles'      => 'required|array',
            'filename'      => 'required|between:2,255',
            'extension'     => 'required|between:2,255',
            'frequency_id'  => 'required|integer',
            'sql'           => 'required',
        ]);

        $object = Report::findOrFail($id);

        $object->fill($data);

        // check is model
        if ($object->isClean()) throw new ModelNotChangeException('At least one value must change');

        // save changes
        $object->save();

        return $object;
    }

    public static function executeReport2(Report $report)
    {
        // Execute query from report task
        $response = DB::select(DB::raw($report->sql));

        if (count($response) === 0) return null;

        Excel::store(new ExportCollection($response), 'public/admin/reports/invoices.xlsx', 'local');

        return 'invoices.xlsx';
    }


    public static function executeReport(Report $report)
    {
        // Execute query from report task
        $response = DB::select(DB::raw($report->sql));

        if (count($response) === 0) return null;

        $filePath = 'public/admin/reports/' . $report->filename . '.' . $report->extension;

        Excel::store(new ExportCollection($response), $filePath, 'local');

        $pathname = storage_path('app/' . $filePath);

        return [
            'pathname'  => $pathname,
            'mime'      => mime_content_type($pathname),
            'size'      => filesize($pathname)
        ];
    }

    /**
     * Transform string data to number data, to operate with excel
     *
     * @param array $response
     * @return array
     */
    private static function castingNumericData(array $response)
    {
        foreach ($response as &$object)
        {
            $fields = get_object_vars($object);
            foreach ($fields as $key => $value)
            {
                if(is_numeric($value) && strpos($value, '.') === false)
                {
                    $object->{$key} = (int) $value;
                }
                elseif(is_numeric($value) && strpos($value, '.') !== false)
                {
                    $object->{$key} = (float) $value;
                }
            }
        }
        return $response;
    }
}
