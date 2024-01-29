<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProjectController extends Controller
{
    public function showProjects(){
        $projects = DB::table('projects')->get();
        return view('pages.projects', ['data' => $projects]);
    }

    public function showAddProjectForm($id = null) {
        $projectData = null;
        if ($id) {
            $projectData = DB::table('projects')->where('id', $id)->first();
            // Handle case if user is not found
        }
        return view('pages.add-project', ['projectData' => $projectData]);
    }

    public function getProjectData(Request $req){

        $projectData = [
            'project_title' => $req->input('project_title'),
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
            if(DB::table('projects')->where('project_title', $projectData['project_title'])->first())
            {
                return response()->json(['error' => 'Project Title already exists']);
            }
            else{
                DB::table('projects')->insert($projectData);
                return response()->json(['success' => 'Project added successfully']);
            }
            if ($req->hasFile('project_media')) {
                foreach ($req->file('project_media') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $filePath = public_path('images/project-media');
                    $file->move($filePath, $filename);

                    DB::table('project_media')->insert([
                        'project_title' => $projectData['project_title'],
                        'media_name' => $filename,
                    ]);
                }
            }
        } 
        catch (\Exception $e) 
        {   
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateProject(Request $req) {
        $projectData = $this->getProjectData($req);
        $id = $req->input('id'); // Get the customer ID from the request
    
        $updated = DB::table('projects')
            ->where('id', $id)
            ->update($projectData);
    
        if ($updated) {
            return response()->json(['success' => 'Customer updated successfully']);
        } else {
            return response()->json(['error' => 'Customer not found or update failed'], 404);
        }
    }

    public function deleteProject(Request $req, $id) {
        try {
            $deleted = DB::table('projects')->where('id', $id)->delete();
    
            if ($deleted) {
                return response()->json(['success' => 'Project deleted successfully']);
            } else {
                return response()->json(['error' => 'Project not found or could not be deleted'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
}
