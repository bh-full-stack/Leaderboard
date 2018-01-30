import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { TopScoresComponent } from './components/top-scores/top-scores.component';

const routes: Routes = [{
  path: '',
  component: TopScoresComponent
}
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class TopScoresRoutingModule { }
