<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function getProjectData(Request $req){

        $projectData = [
            'project_title' => $req->input('project_name'),
            'project_cost' => $req->input('project_cost'),
            'project_description' => $req->input('project_description'),
            'down_payment' => $req->input('down_payment'),
            'development_charges' => $req->input('development_charges'),
            'extra_charges' => $req->input('extra_charges'),
            'monthly_installment' => $req->input('monthly_installment'),
            'project_phase' => $req->input('project_phase'),
            'project_area' => $req->input('project_area'),
            'no_of_plots' => $req->input('no_of_plots'),
            'plot_starting_serial_no' => $req->input('plot_starting_serial_no'),
        ];
    
        if ($req->hasFile('project_logo')) {
            $projectLogo = $req->file('project_logo');
            $projectLogoName = time() . '.' . $projectLogo->getClientOriginalExtension();
            $destinationPath = public_path('images/project-logos');
            $projectLogo->move($destinationPath, $projectLogoName);
            $projectData['project_logo'] = $projectLogoName;
        } else {
            $projectData['project_logo'] = 'default.jpg';
        }
        
        return $projectData;
    }

    public function addProject(Request $req){
        $projectData = $this->getProjectData($req);
        try 
        {   
            // if ($req->hasFile('file')) {
            // $files = $req->file('file'); // 'file' is the name attribute from your input

            // foreach ($files as $file) {
            //     // Process each file
            //     $filename = time() . '_' . $file->getClientOriginalName();
            //     $filePath = $file->storeAs('uploads', $filename, 'public'); // Store the file

            //     // Save file information to the database
            //     DB::table('your_media_table')->insert([
            //         'project_id' => $projectId,
            //         'file_path' => $filePath,
            //         // Add other necessary fields
            //     ]);
            // }
            
                $inserted = DB::table('projects')->insert($projectData);
                return response()->json(['success' => 'Project added successfully']);
            
        } 
        catch (\Exception $e) 
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
