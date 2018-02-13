import { SquadPageComponent } from './components/squad-page/squad-page.component';
import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { SquadListComponent } from './components/squad-list/squad-list.component';
import { SquadCreatorComponent } from './components/squad-creator/squad-creator.component';

const routes: Routes = [
  { path: 'list', component: SquadListComponent },
  { path: 'create', component: SquadCreatorComponent },
  { path: ':squadId', component: SquadPageComponent }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class SquadRoutingModule { }
