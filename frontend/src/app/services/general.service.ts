import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment';
import { lastValueFrom } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class GeneralService {

  constructor(private http: HttpClient) { }

  get(endpoint: string): Promise<any> {
    return lastValueFrom(this.http.get(environment.api_url + endpoint));
  }

  post(endpoint: string, data: any): Promise<any> {
    return lastValueFrom(this.http.post(environment.api_url + endpoint, data));
  }

}
