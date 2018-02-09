import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { AppComponent } from './app.component';
import { NotFoundComponent } from './shared/components/not-found/not-found.component';

const routes: Routes = [
  {
    path: '',
    redirectTo: 'top-scores',
    pathMatch: 'full'
  },
  {
    path: 'top-scores',
    loadChildren: 'app/top-scores/top-scores.module#TopScoresModule'
  },
  {
    path: 'player',
    loadChildren: 'app/player/player.module#PlayerModule'
  },
  {
    path: 'squad',
    loadChildren: 'app/squad/squad.module#SquadModule'
  },
  {
    path: '**',
    component: NotFoundComponent
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
