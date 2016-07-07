<?php

namespace GdaDesenv\AdminDomain\Controllers;

use GdaDesenv\AdminDomain\Entities\Domain;
use DomainWhois\Whois;
use GdaDesenv\AdminClient\Entities\Client;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class DomainController extends Controller
{
    public function index()
    {
        $domains = Domain::all();
        return view('AdminDomain::domain.domains',[
            'domains' => $domains
        ]);
    }

    public function form()
    {
        $clients = Client::all();
        return view('AdminDomain::domain.form',compact('clients'));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_id' => 'required',
            'dominio' => 'required',
            'data_registro' => 'required',
            'data_vencimento' => 'required',
            'orgao_registro' => 'required',
            'valor' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('domain.form')->withErrors($validator)->withInput();
        }

        $domain = new Domain();
        $domain->client_id = $request->input('client_id');
        $domain->dominio = $request->input('dominio');
        $domain->data_registro = $request->input('data_registro');
        $domain->data_vencimento = $request->input('data_vencimento');
        $domain->orgao_registro = $request->input('orgao_registro');
        $domain->valor = $request->input('valor');
        $domain->status = $request->input('status');
        $domain->save();

        $domains = Domain::all();
        return redirect()->route('domains',['domains' => $domains])->with('success', 'Domínio salvo com sucesso!');
    }

    public function edit($id)
    {
        $domain = Domain::find($id);
        $clients = Client::all();

        return view('AdminDomain::domain.edit',[
            'domain' => $domain,
            'clients' => $clients
        ]);
    }

    public function update(Request $request)
    {
        $domain = Domain::find($request->input('id'));

        $validator = Validator::make($request->all(), [
            'client_id' => 'required',
            'dominio' => 'required',
            'data_registro' => 'required',
            'data_vencimento' => 'required',
            'orgao_registro' => 'required',
            'valor' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('domain.edit',['id' => $request->input('id')])->withErrors($validator)->withInput();
        }

        $domain->client_id = $request->input('client_id');
        $domain->dominio = $request->input('dominio');
        $domain->data_registro = $request->input('data_registro');
        $domain->data_vencimento = $request->input('data_vencimento');
        $domain->orgao_registro = $request->input('orgao_registro');
        $domain->valor = $request->input('valor');
        $domain->status = $request->input('status');
        $domain->save();

        $domains = Domain::all();
        return redirect()->route('domains',['domains' => $domains])->with('success', 'Domínio atualizado com sucesso!');
    }

    public function delete($id)
    {
        Domain::destroy($id);

        $domains = Domain::all();
        return redirect()->route('domains',['domains' => $domains])->with('success', 'Domínio removido com sucesso!');
    }

    public function consultWhois(Request $request)
    {
        $domain = $request->input('domain');
        $whois = new Whois($domain);
        $retorno['domain'] = $whois->getDomain();
        $retorno['data_registro'] = dateFormat($whois->getCreated());
        $retorno['data_vencimento'] = dateFormat($whois->getExpires());
        $retorno['status'] = $whois->getStatus();
        return json_encode($retorno);
    }
}
