import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss']
})
export class RegisterComponent implements OnInit {
  public register_form: FormGroup;

  constructor() { 
    this.register_form = this.createFormGroup();
  }

  ngOnInit(): void {
  }

  createFormGroup(){
    return new FormGroup({
      'email_register': new FormControl('', [Validators.required]),
      'password_register': new FormControl('', [Validators.required, Validators.minLength(6)]),
      'confirm_password': new FormControl('', [Validators.required, Validators.minLength(6)]),
      'nombre': new FormControl('', [Validators.required])
    })
  }

  register() {
    console.log(this.register_form.value);
  }

  changePage() {
    
  }
  
  get email_register() { return this.register_form.get('email_register'); }
  get password_register() { return this.register_form.get('password_register'); }
  get confirm_password() { return this.register_form.get('confirm_password'); }
  get nombre() { return this.register_form.get('nombre'); }


}
