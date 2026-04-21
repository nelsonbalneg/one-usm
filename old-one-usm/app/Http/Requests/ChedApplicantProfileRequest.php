<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ChedApplicantProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $userId = Auth::user()->id;

        return [
            // 'app_no' => 'required|unique:ched_applicant_profiles,app_no',

            'app_no' => [
                'required',
                Rule::unique('ched_applicant_profiles', 'app_no')->ignore($userId, 'user_id') // Ignore the current user's email
            ],
            'user_id' => [
                'required',
                Rule::unique('ched_applicant_profiles', 'user_id')->ignore($userId, 'user_id') // Ignore the current user's email
            ],


            'student_category' => 'required|in:0,1',
            'student_category_new_type' => 'nullable|string',
            'student_category_old_type' => 'nullable|string',

            'lrn' => 'nullable|string',

            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'suffix' => 'nullable|string',

            'email' => 'required|email',
            'phone' => 'nullable|string',
            'photo' => 'nullable|string',

            'house_hould_no' => 'required|string',
            'region' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'brgy' => 'required|string',
            'street' => 'required|string',
            'zipcode' => 'required|string',

            'sex' => 'required|string',
            'birthdate' => 'required|date',
            'birthplace' => 'required|string',
            'civil_status' => 'nullable|string',
            // 'others_civil_status' => 'required|string',
            'religion' => 'required|string',
            'citizenship' => 'required|string',
            'first_generation_student' => 'required|in:1,0',

            'is_4ps_beneficiary' => 'required|in:0,1',
            'is_4ps_beneficiary_id' => 'nullable|string',

            'is_solo_parent' => 'required|in:0,1',
            'is_solo_parent_id' => 'nullable|string',

            'is_raised_by_solo_parent' => 'required|in:0,1',
            'is_pwd' => 'required|in:0,1',
            'is_pwd_desc' => 'nullable|string',
            'is_pwd_id' => 'nullable|string',

            'is_gida' => 'required|in:0,1',
            'desc_is_gida' => 'nullable|string',

            'is_ip' => 'required|in:0,1',
            'is_ip_type' => 'nullable|string',

            'is_belong_to_farmer' => 'required|in:0,1',
            'is_rebel_returnee' => 'required|in:0,1',

            'father_name' => 'nullable|string',
            'father_age' => 'nullable|string',
            'father_citizenship' => 'nullable|string',
            'father_highest_educational_attainment' => 'nullable|string',
            'father_employment_status' => 'nullable|string',
            'father_occupation' => 'nullable|string',

            'mother_name' => 'nullable|string',
            'mother_age' => 'nullable|string',
            'mother_citizenship' => 'nullable|string',
            'mother_highest_educational_attainment' => 'nullable|string',
            'mother_employment_status' => 'nullable|string',
            'mother_occupation' => 'nullable|string',

            'family_size' => 'required|string',
            'monthly_income' => 'required|string',

            'type_of_school' => 'required|string',
            'school_name' => 'nullable|string',
            'last_school_year_attended' => 'nullable|string',

            'shs_track' => 'required|string',
            'shs_school_year' => 'required|string',
            'shs_school' => 'required|string',

            'is_adm' => 'required|string',
            'adm_school' => 'nullable|string',
            'adm_school_year' => 'nullable|string',

            'is_als' => 'required|string',
            'als_school' => 'nullable|string',
            'als_school_year' => 'nullable|string',

            'i_agree' => 'nullable|string',
            // 'status' => 'nullable|string',
            'status' => 'nullable|in:0,1'
        ];
    }

    public function messages()
    {
        return [
            'app_no.required' => 'The application number is required and cannot be left blank.',
            'app_no.unique' => 'The application number must be unique and is already in use.',
            'user_id.required' => 'The user ID is required and cannot be omitted.',
            'user_id.unique' => 'This user ID has already been associated with an application.',

            'student_category.required' => 'The student category is required and must be selected.',
            'student_category.in' => 'The student category must be either 0 (new) or 1 (old).',

            'first_name.required' => 'First name is required and cannot be empty.',
            'last_name.required' => 'Last name is required and cannot be empty.',

            'region.required' => 'Please specify the region.',
            'province.required' => 'Please specify the province.',
            'city.required' => 'City name is required.',
            'brgy.required' => 'Barangay is required.',

            'sex.required' => 'Sex is a required field.',
            'birthdate.required' => 'Birthdate is required and cannot be left blank.',
            'birthdate.date' => 'The birthdate must be in a valid date format.',
            'birthplace.required' => 'Birthplace is required.',

            'civil_status.required' => 'Civil status is required and cannot be left blank.',
            'religion.required' => 'Religion is required and cannot be empty.',
            'citizenship.required' => 'Citizenship is required and cannot be blank.',

            'first_generation_student.required' => 'Please specify if you are a first-generation student.',
            'first_generation_student.boolean' => 'This field must be true (yes) or false (no).',

            'is_4ps_beneficiary.required' => 'Please indicate whether you are a 4Ps beneficiary.',
            'is_solo_parent.required' => 'Please indicate if you are a solo parent.',
            'is_raised_by_solo_parent.required' => 'Please indicate if you were raised by a solo parent.',
            'is_pwd.required' => 'Please specify if you are a person with a disability.',
            'is_gida.required' => 'Please specify if you belong to a GIDA area.',
            'is_ip.required' => 'Please specify if you are an Indigenous Person (IP).',
            'is_belong_to_farmer.required' => 'Please specify if you belong to a farmer’s family.',
            'is_rebel_returnee.required' => 'Please indicate if you are a rebel returnee.',

            'family_size.required' => 'Family size is required and cannot be blank.',
            'monthly_income.required' => 'Monthly income is required and must be provided.',

            'type_of_school.required' => 'Please specify the type of school.',
            'shs_track.required' => 'The SHS track is required.',
            'shs_school_year.required' => 'SHS school year is required.',
            'shs_school.required' => 'The SHS school is required.',
        ];
    }
}
