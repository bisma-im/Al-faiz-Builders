<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class ProjectController extends Controller
{
    public function showProjects(Request $req){
        $projects = DB::table('projects')->get();
        return view('pages.projects', ['data' => $projects]);
    }

    public function showPlots(Request $req, $id){
        $categories = DB::table('plots_inventory')
                        ->select('category')
                        ->where('phase_id', $id)
                        ->groupby('category')
                        ->orderBy('category', 'desc')
                        ->get();
        $plots = DB::table('plots_inventory as p')
                    ->leftJoin('booking as b', 'p.id', '=', 'b.plot_id')
                    ->leftJoin('customer as c', 'c.id', '=', 'b.customer_id')
                    ->select('b.id as booking_id', 'p.id', 'p.plot_no', 'p.amount', 'p.category', DB::raw('IFNULL(b.created_on, "Not Booked") as created_on'), DB::raw('IFNULL(c.name, "Not Booked") as name'))
                    ->where('p.phase_id', $id)
                    ->get();
        $lastPlotIds = DB::table('plots_inventory')
                     ->select(DB::raw('MAX(id) as last_id'), 'category')
                     ->where('phase_id', $id)
                     ->groupBy('category')
                     ->pluck('last_id', 'category')->all();
        // dd($lastPlotIds);
        return view('pages.plots', compact('categories','plots', 'lastPlotIds'));
    }

    public function deletePlot(Request $req){
        try
        {
            $id = $req->input('plotId');
            $plotInfo = DB::table('plots_inventory')->select('phase_id', 'category')->where('id', $id)->first();
            $deleted = DB::table('plots_inventory')->where('id',$id)->delete();
            if($deleted){
                return response()->json(['success' => 'Plot deleted successfully']);
            }
        } 
        catch (\Exception $e) 
        {   
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function showAddProjectForm($id = null) {
        $projectData = null;
        $phaseData = [];
        if ($id) 
        {
            $projectData = DB::table('projects')
                ->where('id', $id)
                ->first();
            $phaseData = DB::table('phase')
                ->join('projects as pr', 'pr.id', '=', 'phase.project_id')
                ->select('phase.*', 'pr.project_title')
                ->where('pr.id', $id)
                ->get();
            if (!$projectData) {
                return redirect()->route('showProjects');
            }
        }
        return view('pages.add-project', compact('projectData','phaseData'));
    }

    public function showAddPhaseForm(Request $req, $projectId=null, $phaseId=null) {
        $phaseData = null;
        
        if ($projectId && $phaseId) 
        {
            $phaseData = DB::table('phase')
                ->where('id', $phaseId)
                ->first();
            $formattedDateTime = Carbon::createFromFormat('Y-m-d', $phaseData->completion_date)->format('Y-m-d');
            $phaseData->formattedDateTime = $formattedDateTime;
            if (!$phaseData) {
                return redirect()->route('showProjects');
            }
        } else {
            $projectId = $req->input('project_id');
        }
        
        $projects = DB::table('projects')->get();
        return view('pages.add-phase', compact('phaseData','projectId','projects'));
    }

    public function getPhaseData(Request $req){
        $phaseCompletionDate = Carbon::createFromFormat('Y-m-d', $req->input('completion_date'));
        $phaseData = [
            'project_id' => $req->input('project_id'),
            'phase_title' => $req->input('phase_name'),
            'phase_cost' => $req->input('phase_cost'),
            'down_payment' => $req->input('down_payment'),
            'development_charges' => $req->input('development_charges'),
            'extra_charges' => $req->input('extra_charges'),
            'monthly_installment' => $req->input('monthly_installment'),
            'phase_area' => $req->input('phase_area'),
            'completion_date' => $phaseCompletionDate->toDateString(),
        ];
    
        if ($req->hasFile('phase_logo')) {
            $phaseLogo = $req->file('phase_logo');
            $phaseLogoName = time() . '.' . $phaseLogo->getClientOriginalExtension();
            $destinationPath = public_path('images/phase-logos');
            $phaseLogo->move($destinationPath, $phaseLogoName);
            $phaseData['phase_logo'] = $phaseLogoName;
        } else {
            $phaseData['phase_logo'] = 'default.svg';
        }
        
        return $phaseData;
    }

    public function addPhase(Request $req){
        $phaseData = $this->getPhaseData($req);
        $categories = $req->input('kt_ecommerce_add_plot_options');
        $plotInventory=[];
        $projectId= $phaseData['project_id'];
        $phaseId=0;
        
        DB::beginTransaction();
        try 
        {   
            $phaseId = DB::table('phase')->insertGetId($phaseData);
            foreach($categories as $category)
            {
                $totalPlots = $category['no_of_plots'];
                $plotPrefix = $category['plot_prefix'];
                $amount = $category['amount'];
                $cat = $category['category'];
                $type = $category['plot_or_shop'];
                for($i = 1; $i <= $totalPlots; $i++)
                {
                    $plotInventory[] = [
                        'category' => $cat,
                        'project_id' => $projectId,
                        'phase_id' => $phaseId,
                        'amount' => $amount,
                        'plot_or_shop' => $type,
                        'plot_no' => $plotPrefix . $i,
                    ];
                }
            }
            
            $insertedPlots = DB::table('plots_inventory')->insert($plotInventory);
            if ($req->hasFile('phase_media')) {
                foreach ($req->file('phase_media') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $filePath = public_path('images/phase-media');
                    $file->move($filePath, $filename);

                    DB::table('phase_media')->insert([
                        'phase_id' => $phaseId,
                        'project_id' => $projectId,
                        'media_name' => $filename,
                    ]);
                }
            }
            DB::commit();
            return response()->json(['success' => 'Phase added successfully']);
        } 
        catch (\Exception $e) 
        {   
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getProjectData(Request $req){

        $projectData = [
            'project_title' => $req->input('project_title'),
            'project_description' => $req->input('project_description'),
            'status' => $req->input('status'),
        ];
    
        if ($req->hasFile('project_logo')) {
            $projectLogo = $req->file('project_logo');
            $projectLogoName = time() . '.' . $projectLogo->getClientOriginalExtension();
            $destinationPath = public_path('images/project-logos');
            $projectLogo->move($destinationPath, $projectLogoName);
            $projectData['project_logo'] = $projectLogoName;
        } else if ($req->input('existing_project_logo') != 'default.svg' && !$req->hasFile('project_logo')) {
            $projectData['project_logo'] = $req->input('existing_project_logo');
        } else {
            if (!$req->input('id')) {
                $customerData['project_logo'] = 'default.svg';
            }
        }
        
        return $projectData;
    }

    public function addProject(Request $req){
        $projectData = $this->getProjectData($req);
        DB::beginTransaction();
        try 
        {   
            DB::table('projects')->insert($projectData);
            if ($req->hasFile('project_media')) {
                foreach ($req->file('project_media') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $filePath = public_path('images/project-media');
                    $file->move($filePath, $filename);

                    DB::table('project_media')->insert([
                        'project_id' => $projectId,
                        'media_name' => $filename,
                    ]);
                }
            }
            DB::commit();
            return response()->json(['success' => 'Project added successfully']);
        } 
        catch (\Exception $e) 
        {   
            DB::rollBack();
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

    public function updatePhase(Request $req) {
        $phaseData = $this->getPhaseData($req);
        $id = $req->input('id'); // Get the customer ID from the request
    
        $updated = DB::table('phase')
            ->where('id', $id)
            ->update($phaseData);
    
        if ($updated) {
            return response()->json(['success' => 'Phase updated successfully']);
        } else {
            return response()->json(['error' => 'Phase not found or update failed'], 404);
        }
    }

    public function deleteProject(Request $req, $id) {
        DB::beginTransaction();
        try {
            $projectLogo = DB::table('projects')->where('id', $id)->value('project_logo');
        
            // Collect paths of files to delete, but do not actually delete them yet
            $filesToDelete = [];
            if ($projectLogo && $projectLogo != 'default.svg') {
                $filesToDelete[] = public_path('images/project-logos/' . $projectLogo);
            }

            // Collect media files
            $mediaFiles = DB::table('project_media')->where('project_id', $id)->pluck('media_name');
            foreach ($mediaFiles as $fileName) {
                $filesToDelete[] = public_path('images/project-media/' . $fileName);
            }

            // Collect phase logos
            $phaseLogos = DB::table('phase')->where('project_id', $id)->pluck('phase_logo');
            foreach ($phaseLogos as $phaseLogo) {
                $filesToDelete[] = public_path('images/phase-logos/' . $phaseLogo);
            }
    
            DB::table('project_media')->where('project_id', $id)->delete();
            DB::table('phase_media')->where('project_id', $id)->delete();
            DB::table('plots_inventory')->where('project_id', $id)->delete();
            DB::table('phase')->where('project_id', $id)->delete();
            $deleted = DB::table('projects')->where('id', $id)->delete();
    
            if ($deleted) {
                DB::commit();
                foreach ($filesToDelete as $filePath) {
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
                return response()->json(['success' => 'Project deleted successfully']);
            } else {
                return response()->json(['error' => 'Project not found or could not be deleted'], 404);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    
}
