    @if (!empty($updateMessage))
        <div class="alert alert-success" id="success-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $updateMessage }}
        </div>
    @endif

    @if (!empty($deleteMessage))
        <div class="alert alert-success" id="danger-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $deleteMessage }}
        </div>
    @endif

<button class="btn btn-success btn-sm btn-lg pull-right" wire:click="show_add_form" type="button">{{ trans('site.add_parent') }}</button><br><br>
<div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>#</th>
            <th>{{ trans('site.email') }}</th>
            <th>{{ trans('site.name_father') }}</th>
            <th>{{ trans('site.national_id_father') }}</th>
            <th>{{ trans('site.passport_id_father') }}</th>
            <th>{{ trans('site.phone_father') }}</th>
            <th>{{ trans('site.job_father') }}</th>
            <th>{{ trans('site.processes') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($parents as $parent)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $parent->email }}</td>
                <td>{{ $parent->name_father }}</td>
                <td>{{ $parent->national_id_father }}</td>
                <td>{{ $parent->passport_id_father }}</td>
                <td>{{ $parent->phone_father }}</td>
                <td>{{ $parent->job_father }}</td>
                <td>
                    <button wire:click="edit({{ $parent->id }})" title="{{ trans('site.edit') }}"
                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $parent->id }})" title="{{ trans('site.delete') }}"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        @endforeach
    </table>
</div>