<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Team::with('leader')->with('members')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // how to validate other params?
        $request->validate([
            'needs' => 'required|string|max:500'
        ]);

        Team::create([
            'leader_id' => $request->user()->phone,
            'needs' => $request->needs
        ]);

        $members = [];

        if (!empty($request->members)) {
            foreach ($request->members as $member) {

                $members[] = [
                    "team_id" => $request->user()->phone,
                    "name" => $member['name'],
                    "department" => $member['department'],
                    "major" => $member['major']
                ];
            }

            Member::insert($members);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Team::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // update the team needs
        if ($request->needs) {
            Team::find($id)->update([
                'needs' => $request->needs
            ]);
        }

        if (!empty($request->members)) {
            foreach ($request->members as $m) {
                $member = Member::where([
                    'name' => $m['old_name'],
                    'department' => $m['old_department'],
                    'major' => $m['old_major']
                ])->update([
                    'name' => $m['new_name'] ? $m['new_name'] : $m['old_name'],
                    'department' => $m['new_department'] ? $m['new_department'] : $m['old_department'],
                    'major' => $m['new_major'] ? $m['new_major'] : $m['old_major']
                ]);

                // creating the member if it doesn't exist
                if (!$member) {
                    Member::create([
                        'team_id' => Auth::user()->phone,
                        'name' => $m['new_name'],
                        'department' => $m['new_department'],
                        'major' => $m['new_major']
                    ]);
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search($keyword)
    {
        return Team::with('leader')
            ->with('members')
            ->where('needs', 'like', '%' . $keyword . '%')
            ->get();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
