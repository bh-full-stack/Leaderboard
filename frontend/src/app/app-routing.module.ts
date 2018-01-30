import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { AppComponent } from './app.component';

const routes: Routes = [
  {
    path: '',
    redirectTo: 'top-scores',
    pathMatch: 'full'
  },
  {
    path: 'top-scores',
    loadChildren: 'app/top-scores/top-scores.module#TopScoresModule'
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
