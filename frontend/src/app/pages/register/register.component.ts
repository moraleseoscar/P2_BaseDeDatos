import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { GeneralService } from 'src/app/services/general.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss']
})
export class RegisterComponent implements OnInit {
  public register_form: FormGroup;

  constructor(private general_service: GeneralService) { 
    this.register_form = this.createFormGroup();
  }

  ngOnInit(): void {
  }

  createFormGroup(){
    return new FormGroup({
      'email': new FormControl('', [Validators.required]),
      'password': new FormControl('', [Validators.required, Validators.minLength(6)]),
      'password_confirmation': new FormControl('', [Validators.required, Validators.minLength(6)]),
      'nombre': new FormControl('', [Validators.required])
    })
  }

  register() {
    console.log(this.register_form.value);
    const data = Object.assign(this.register_form.value, {tipo: 'client'});
    this.general_service.post('register', data).then(res => console.log(res)).catch(err => console.log(err));
  }
  
  get email() { return this.register_form.get('email'); }
  get password() { return this.register_form.get('password'); }
  get password_confirmation() { return this.register_form.get('password_confirmation'); }
  get nombre() { return this.register_form.get('nombre'); }


}
