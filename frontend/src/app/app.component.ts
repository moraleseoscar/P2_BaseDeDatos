import { Component } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  public login_form: FormGroup;
  public register_form: FormGroup;
  public is_login: boolean = true;

  constructor() {
    this.login_form = this.createFormGroup();
    this.register_form = this.createFormGroup1();
  }

  createFormGroup(){
    return new FormGroup({
      'email': new FormControl('', [Validators.required]),
      'password': new FormControl('', [Validators.required, Validators.minLength(6)])
    })
  }
  
  createFormGroup1(){
    return new FormGroup({
      'email_register': new FormControl('', [Validators.required]),
      'password_register': new FormControl('', [Validators.required, Validators.minLength(6)]),
      'confirm_password': new FormControl('', [Validators.required, Validators.minLength(6)]),
      'nombre': new FormControl('', [Validators.required])
    })
  }

  login() {
    console.log(this.login_form.value);
  }

  register() {
    console.log(this.register_form.value);
  }

  changePage() {
    this.is_login = !this.is_login;
  }

  get email() { return this.login_form.get('email'); }
  get password() { return this.login_form.get('password'); }


  get email_register() { return this.login_form.get('email_register'); }
  get password_register() { return this.login_form.get('password_register'); }
  get confirm_password() { return this.login_form.get('confirm_password'); }
  get nombre() { return this.login_form.get('nombre'); }



}
