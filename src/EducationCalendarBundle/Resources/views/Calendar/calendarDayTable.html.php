<table class="table-bordered table table-hover calendarViewCustomTable">
    <thead>
    <tr>
        <th width="5%">Stunde</th>
        <th width="5%">Raum</th>
        <th width="10%">Klasse</th>
        <th width="40%">Inhalt</th>
        <th width="40%">Notiz</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data['content'] as $x => $contentdata): ?>
        <tr>
            <td><?php echo $contentdata['stunde']; ?></td>
            <td class="calendarViewSmallTD">
                <label>
                    <input type="text" class="calendarViewSmallInput form-control no-padding-horizontal text-center" autocomplete="off" />
                </label>
            </td>
            <td class="calendarViewSmallTD">
                <label>
                    <input type="text" class="calendarViewSmallInput form-control no-padding-horizontal text-center" autocomplete="off" />
                </label>
            </td>
            <td class="calendarViewSmallTD">
                <label>
                    <input type="text" class="calendarViewSmallInput form-control no-padding-horizontal text-center" autocomplete="off" />
                </label>
            </td>
            <td class="calendarViewTableTextAreaTD">
                <label>
                    <textarea class="calendarViewTableTextArea form-control no-padding-horizontal height-34" rows="1" autocomplete="off"></textarea>
                </label>
            </td>
            <td class="calendarViewTableTextAreaTD">
                <label>
                    <textarea class="calendarViewTableTextArea form-control no-padding-horizontal height-34" rows="1" autocomplete="off"></textarea>
                </label>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
